<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Intervention\Image\Facades\Image; // This import is not directly used in the extractGeoLocation method provided, but keep it if you use it elsewhere.
use Illuminate\Support\Facades\Storage; // Import Storage facade

class Field extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'size', 'photo_path', 'location', 'notes', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Extracts geolocation (latitude and longitude) from photo EXIF data.
     *
     * @param string $photoPath The path to the photo relative to the storage disk (e.g., 'fields_photos/image.jpg').
     * @return string|null A WKT POINT string (e.g., 'POINT(lng lat)') or null if no GPS data.
     */
    public static function extractGeoLocation($photoPath)
    {
        // Get the full absolute path to the stored file
        $fullPhotoPath = Storage::disk('public')->path($photoPath);

        // Check if the file exists and is readable
        if (!file_exists($fullPhotoPath) || !is_readable($fullPhotoPath)) {
            \Log::warning("Cannot read photo file for EXIF: " . $fullPhotoPath);
            return null;
        }

        // Attempt to read EXIF data
        $exif = @exif_read_data($fullPhotoPath); // Use @ to suppress warnings for non-EXIF files

        if (isset($exif['GPSLatitude']) && isset($exif['GPSLongitude'])) {
            try {
                $lat = self::gpsToDecimal($exif['GPSLatitude'], $exif['GPSLatitudeRef'] ?? 'N');
                $lng = self::gpsToDecimal($exif['GPSLongitude'], $exif['GPSLongitudeRef'] ?? 'E');
                return "POINT($lng $lat)"; // Return as WKT POINT string
            } catch (\Exception $e) {
                \Log::error("Error extracting GPS from EXIF for {$photoPath}: " . $e->getMessage());
                return null;
            }
        }
        return null;
    }

    /**
     * Converts GPS coordinate parts to a decimal degree value.
     *
     * @param array $coordinate Array of degrees, minutes, seconds fractions.
     * @param string $hemisphere Hemisphere reference (N, S, E, W).
     * @return float Decimal degree value.
     */
    private static function gpsToDecimal($coordinate, $hemisphere)
    {
        $degrees = count($coordinate) > 0 ? self::fracToDec($coordinate[0]) : 0;
        $minutes = count($coordinate) > 1 ? self::fracToDec($coordinate[1]) : 0;
        $seconds = count($coordinate) > 2 ? self::fracToDec($coordinate[2]) : 0;
        $sign = ($hemisphere == 'W' || $hemisphere == 'S') ? -1 : 1;
        return $sign * ($degrees + $minutes/60 + $seconds/3600);
    }

    /**
     * Converts a fraction string (e.g., "1/2") to a decimal.
     *
     * @param string $fraction The fraction string.
     * @return float The decimal value.
     */
    private static function fracToDec($fraction)
    {
        $parts = explode('/', $fraction);
        if (count($parts) == 2 && $parts[1] != 0) {
            return (float) $parts[0] / (float) $parts[1];
        }
        return (float) $parts[0]; // Handle cases like "10/1" or "10"
    }

    /**
     * Accessor and Mutator for the 'location' attribute.
     * Converts WKT to Lat/Lng on get, and Lat/Lng to PostGIS geometry on set.
     */
    protected function location(): Attribute
    {
        return Attribute::make(
            // Accessor: Converts PostGIS geometry to an object with lat/lng
            get: fn ($value) => $value ? (object)\DB::selectOne("SELECT ST_X(location) as lng, ST_Y(location) as lat FROM fields WHERE id = ?", [$this->id]) : null,
            // Mutator: Converts WKT POINT string to PostGIS geometry
            set: fn ($value) => $value ? \DB::raw("ST_GeomFromText('$value', 4326)") : null,
        );
    }
}