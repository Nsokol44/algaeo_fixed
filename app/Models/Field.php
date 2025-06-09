<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import HasMany for the new relationship
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; // Make sure DB facade is imported

class Field extends Model
{
    use HasFactory;

    protected $table = 'fields'; // Explicitly define table name
    protected $primaryKey = 'id'; // Explicitly define primary key

    protected $fillable = [
        'name',
        'type',
        'crops_grown',
        'size',
        'photo_path',
        'location',
        'notes',
        'user_id'
    ];

    /**
     * Get the user that owns the field.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the metrics for the field.
     * This defines the one-to-many relationship with FieldMetric.
     */
    public function metrics(): HasMany
    {
        return $this->hasMany(FieldMetric::class);
    }

    /**
     * Get the URL for the field's photo.
     */
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo_path ? Storage::url($this->photo_path) : null;
    }

    /**
     * Extracts geographical location (latitude, longitude) from EXIF data of a photo.
     * Returns a WKT POINT string (e.g., "POINT(lng lat)") or null.
     */
    public static function extractGeoLocation(string $photoPath): ?string
    {
        $fullPhotoPath = Storage::disk('public')->path($photoPath);

        if (!file_exists($fullPhotoPath) || !is_readable($fullPhotoPath)) {
            Log::warning("Cannot read photo file for EXIF: " . $fullPhotoPath);
            return null;
        }

        $exif = @exif_read_data($fullPhotoPath);

        if (isset($exif['GPSLatitude']) && isset($exif['GPSLongitude'])) {
            try {
                $lat = self::gpsToDecimal($exif['GPSLatitude'], $exif['GPSLatitudeRef'] ?? 'N');
                $lng = self::gpsToDecimal($exif['GPSLongitude'], $exif['GPSLongitudeRef'] ?? 'E');
                return "POINT($lng $lat)";
            } catch (\Exception $e) {
                Log::error("Error extracting GPS from EXIF for {$photoPath}: " . $e->getMessage());
                return null;
            }
        }
        return null;
    }

    /**
     * Converts GPS coordinates from EXIF format to decimal degrees.
     */
    private static function gpsToDecimal(array $coordinate, string $hemisphere): float
    {
        $degrees = count($coordinate) > 0 ? self::fracToDec($coordinate[0]) : 0.0;
        $minutes = count($coordinate) > 1 ? self::fracToDec($coordinate[1]) : 0.0;
        $seconds = count($coordinate) > 2 ? self::fracToDec($coordinate[2]) : 0.0;
        $sign = ($hemisphere == 'W' || $hemisphere == 'S') ? -1 : 1;
        return $sign * ($degrees + $minutes / 60 + $seconds / 3600);
    }

    /**
     * Converts a fraction string (e.g., "1/2") to a float.
     */
    private static function fracToDec(string $fraction): float
    {
        $parts = explode('/', $fraction);
        if (count($parts) == 2 && (float)$parts[1] != 0) {
            return (float) $parts[0] / (float) $parts[1];
        }
        return (float) $parts[0];
    }

    /**
     * Accessor and Mutator for the 'location' attribute.
     *
     * Accessor: When retrieving 'location' from the database, converts PostGIS geometry
     * into a formatted string (Latitude, Longitude) or null.
     * Mutator: Converts WKT POINT string to PostGIS geometry.
     */
    protected function location(): Attribute
    {
        return Attribute::make(
            // Accessor: When retrieving 'location' from the database, return a formatted string
            get: fn ($value) => $value ? (function() use ($value) {
                // This assumes `location` column is already a PostGIS geometry type
                // and we're fetching its X (longitude) and Y (latitude) coordinates.
                $coords = \DB::selectOne("SELECT ST_X(location) as lng, ST_Y(location) as lat FROM fields WHERE id = ?", [$this->id]);
                if ($coords && isset($coords->lat) && isset($coords->lng)) {
                    return number_format($coords->lat, 6) . ', ' . number_format($coords->lng, 6);
                }
                return null;
            })() : null,
            // Mutator: When setting 'location' before saving to the database
            // It expects a WKT POINT string (e.g., "POINT(lng lat)")
            set: fn ($value) => $value ? \DB::raw("ST_GeomFromText('$value', 4326)") : null,
        );
    }
}
