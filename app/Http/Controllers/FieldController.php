<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\FieldMetric; // Import the new FieldMetric model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Import Str facade for string operations

class FieldController extends Controller
{
    /**
     * Display a listing of the fields for the authenticated user on the dashboard.
     */
    public function index()
    {
        $fields = Auth::user()->fields()->latest()->get();
        return view('dashboard', compact('fields'));
    }

    /**
     * Show the form for creating a new field.
     */
    public function create()
    {
        return view('fields.create');
    }

    /**
     * Store a newly created field in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:Field,Garden Bed,Plot',
            'crops_grown' => 'nullable|string',
            'size' => 'required|numeric|min:0',
            'photo' => 'nullable|image|max:25000', // Increased to 25MB (was 10MB)
            'location' => 'nullable|string|max:255', // Expecting 'lat, lng' or WKT POINT
            'notes' => 'nullable|string',
        ]);

        $photoPath = null;
        $geoLocationWKT = null; // Initialize to null for WKT POINT string

        // Handle manual location input from the form (as 'lat, lng' or WKT)
        if (!empty($validatedData['location'])) {
            // Check if it's already a WKT POINT string
            if (Str::startsWith(strtoupper(trim($validatedData['location'])), 'POINT(')) {
                $geoLocationWKT = $validatedData['location'];
            } else {
                // Assume 'lat, lng' format
                $coords = explode(',', $validatedData['location']);
                if (count($coords) == 2 && is_numeric(trim($coords[0])) && is_numeric(trim($coords[1]))) {
                    $lat = trim($coords[0]);
                    $lng = trim($coords[1]);
                    $geoLocationWKT = "POINT($lng $lat)"; // Convert to WKT format (lng lat)
                } else {
                    Log::warning("Invalid manual location format during store: " . $validatedData['location']);
                }
            }
        }

        if ($request->hasFile('photo')) {
            $photoFile = $request->file('photo');
            $photoPath = $photoFile->store('field_photos', 'public');

            // Extract geo location from EXIF and override manual input if found
            $extractedGeoLocationWKT = Field::extractGeoLocation($photoPath);
            if ($extractedGeoLocationWKT) {
                $geoLocationWKT = $extractedGeoLocationWKT; // EXIF data takes precedence
            }

            try {
                $manager = new ImageManager(new Driver());
                $image = $manager->read(Storage::disk('public')->path($photoPath));
                $image->cover(800, 600);
                $image->save(Storage::disk('public')->path($photoPath));
            } catch (\Exception $e) {
                Log::error("Error resizing image for {$photoPath}: " . $e->getMessage());
            }
        }

        Auth::user()->fields()->create([
            'name' => $validatedData['name'],
            'type' => $validatedData['type'],
            'crops_grown' => $validatedData['crops_grown'],
            'size' => $validatedData['size'],
            'photo_path' => $photoPath,
            'location' => $geoLocationWKT, // This will be handled by the GeometryPointCast mutator
            'notes' => $validatedData['notes'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Field registered successfully!');
    }

    /**
     * Display the specified field.
     */
    public function show($fieldId)
    {
        $field = Field::findOrFail($fieldId);

        // Ensure the authenticated user owns this field
        if ($field->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // --- Fetch Actual Data for Charts from FieldMetric model ---
        // Fetch all relevant metrics for growth rate and NPK in one query
        $rawGrowthRateAndNpkData = $field->metrics()
            ->whereIn('metric_type', ['growth_rate', 'nitrogen', 'phosphorus', 'potassium'])
            ->orderBy('recorded_at', 'asc')
            ->get();

        // Process growth rate and NPK data for combined chart
        $processedGrowthNpkData = [];
        // Group the fetched metrics by their recorded date (YYYY-MM-DD)
        $groupedByDate = $rawGrowthRateAndNpkData->groupBy(function($item) {
            // Ensure 'recorded_at' is treated as a Carbon instance for formatting
            return $item->recorded_at->format('Y-m-d');
        });

        // Iterate through each date group to build the data points for the chart
        foreach ($groupedByDate as $dateString => $metricsForDate) {
            $dataPoint = [
                'date' => $dateString, // The date string for the x-axis
                'growth' => $metricsForDate->where('metric_type', 'growth_rate')->first()->value ?? 0,
                'N' => $metricsForDate->where('metric_type', 'nitrogen')->first()->value ?? 0,
                'P' => $metricsForDate->where('metric_type', 'phosphorus')->first()->value ?? 0,
                'K' => $metricsForDate->where('metric_type', 'potassium')->first()->value ?? 0,
            ];
            $processedGrowthNpkData[] = $dataPoint;
        }

        // Fetch temperature data
        $temperatureData = $field->metrics()
            ->where('metric_type', 'temperature')
            ->orderBy('recorded_at', 'asc')
            ->get();

        // Fetch precipitation data
        $precipitationData = $field->metrics()
            ->where('metric_type', 'precipitation')
            ->orderBy('recorded_at', 'asc')
            ->get();
        // --- End Fetch Actual Data ---

        return view('fields.show', compact('field', 'processedGrowthNpkData', 'temperatureData', 'precipitationData'));
    }

    /**
     * Show the form for editing the specified field.
     */
    public function edit($fieldId)
    {
        $field = Field::findOrFail($fieldId);

        // Ensure the authenticated user owns this field
        if ($field->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('fields.edit', compact('field'));
    }

    /**
     * Update the specified field in storage.
     */
    public function update(Request $request, Field $field)
    {
        // Ensure the authenticated user owns this field
        if ($field->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:Field,Garden Bed,Plot',
            'crops_grown' => 'nullable|string',
            'size' => 'required|numeric|min:0',
            'photo' => 'nullable|image|max:25000', // Increased to 25MB (was 10MB)
            'location' => 'nullable|string|max:255', // This will be the manual input 'lat, lng' string or WKT
            'notes' => 'nullable|string',
        ]);

        $photoPath = $field->photo_path;
        $geoLocationWKT = null; // Initialize to null for WKT POINT string

        // Determine the location to be saved
        if (!empty($validatedData['location'])) {
            // Check if it's already a WKT POINT string
            if (Str::startsWith(strtoupper(trim($validatedData['location'])), 'POINT(')) {
                $geoLocationWKT = $validatedData['location'];
            } else {
                // Assume 'lat, lng' format
                $coords = explode(',', $validatedData['location']);
                if (count($coords) == 2 && is_numeric(trim($coords[0])) && is_numeric(trim($coords[1]))) {
                    $lat = trim($coords[0]);
                    $lng = trim($coords[1]);
                    $geoLocationWKT = "POINT($lng $lat)"; // Convert to WKT format (lng lat)
                } else {
                    Log::warning("Invalid manual location format during update: " . $validatedData['location']);
                    // If manual input is invalid, and no new photo, retain existing DB value
                    $geoLocationWKT = $field->getRawOriginal('location');
                }
            }
        } else {
            // If manual location input is empty, and no new photo, retain existing DB value
            if (!$request->hasFile('photo')) {
                 $geoLocationWKT = $field->getRawOriginal('location');
            }
        }

        // Handle photo upload and EXIF data extraction
        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            $photoFile = $request->file('photo');
            $photoPath = $photoFile->store('field_photos', 'public');

            // Extract geo location from EXIF and override any manual input if found
            $extractedGeoLocationWKT = Field::extractGeoLocation($photoPath); // Returns WKT POINT string or null
            if ($extractedGeoLocationWKT) {
                $geoLocationWKT = $extractedGeoLocationWKT; // EXIF data takes precedence
            }

            try {
                $manager = new ImageManager(new Driver());
                $image = $manager->read(Storage::disk('public')->path($photoPath));
                $image->cover(800, 600);
                $image->save(Storage::disk('public')->path($photoPath));
            } catch (\Exception $e) {
                Log::error("Error resizing image for {$photoPath}: " . $e->getMessage());
            }
        }

        $field->update([
            'name' => $validatedData['name'],
            'type' => $validatedData['type'],
            'crops_grown' => $validatedData['crops_grown'],
            'size' => $validatedData['size'],
            'photo_path' => $photoPath,
            'location' => $geoLocationWKT, // This will be handled by the GeometryPointCast mutator
            'notes' => $validatedData['notes'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Field updated successfully!');
    }

    /**
     * Remove the specified field from storage.
     */
    public function destroy(Field $field)
    {
        // Ensure the authenticated user owns this field
        if ($field->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($field->photo_path) {
            Storage::disk('public')->delete($field->photo_path);
        }

        $field->delete();

        return redirect()->route('dashboard')->with('success', 'Field deleted successfully!');
    }
}
