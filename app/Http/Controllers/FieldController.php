<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image; // Ensure this is imported for image processing

class FieldController extends Controller
{
    /**
     * Display a listing of the fields for the authenticated user on the dashboard.
     */
    public function index()
    {
        // Get all fields belonging to the currently authenticated user
        // Eager load the user relationship if needed, though not strictly necessary for just displaying fields
        $fields = Auth::user()->fields()->orderBy('created_at', 'desc')->get();

        // Return the dashboard view, passing the fields
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
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:256000', // 'photo' is the input name for the file
            'size' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Store the uploaded photo in the 'public' disk under a 'field-photos' directory
        $photoPath = $request->file('photo')->store('field-photos', 'public');
        
        // Resize image using Intervention Image
        // Ensure the directory exists for the image to be saved to
        $fullPhotoPath = Storage::disk('public')->path($photoPath);
        
       Image::read($fullPhotoPath)
            ->cover(800, 600) // Changed from fit() to cover()
            ->save($fullPhotoPath);// Overwrite the original stored image with the resized one

        $field = new Field([
            'name' => $request->name,
            'size' => $request->size,
            'photo_path' => $photoPath, // Store the path to the photo
            'notes' => $request->notes,
            'user_id' => Auth::id(),
        ]);

        // Extract geolocation from the uploaded photo using the Field model's method
        // Pass the path relative to the 'public' disk root
        if ($geo = Field::extractGeoLocation($photoPath)) {
            $field->location = $geo; // The mutator in Field model will handle conversion to PostGIS geometry
        }

        $field->save();

        // Redirect to the dashboard after successful registration
        return redirect()->route('dashboard')->with('success', 'Field registered successfully!');
    }

    /**
     * Display the specified field.
     */
    public function show(Field $field)
    {
        // Authorize the view action using a policy (if defined)
        // Ensure you have a FieldPolicy if this line is active
        // $this->authorize('view', $field);

        // Alternatively, if no policy, manually check ownership:
        if (Auth::id() !== $field->user_id) {
            abort(403, 'Unauthorized action.'); // Or redirect to dashboard with error
        }

        return view('fields.show', compact('field'));
    }
}
