<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GeometryPointCast implements CastsAttributes
{
    /**
     * Cast the given value from the database.
     * Converts PostGIS geometry to a stdClass object with lat and lng.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (is_null($value)) {
            return null;
        }

        // Use DB::selectOne to convert the geometry column into readable lat/lng values
        // This is necessary because raw geometry data isn't directly usable by PHP
        try {
            $coords = DB::selectOne("SELECT ST_X(location) as lng, ST_Y(location) as lat FROM {$model->getTable()} WHERE id = ?", [$model->id]);
            if ($coords && isset($coords->lat) && isset($coords->lng)) {
                return (object)['lat' => (float) $coords->lat, 'lng' => (float) $coords->lng];
            }
        } catch (\Exception $e) {
            Log::error("Error casting geometry point for field ID {$model->id}: " . $e->getMessage());
        }

        return null;
    }

    /**
     * Prepare the given value for storage.
     * Converts a WKT POINT string (e.g., "POINT(lng lat)") to PostGIS geometry.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        // $value is expected to be a WKT string (e.g., "POINT(lng lat)") or null
        if (is_null($value)) {
            return null;
        }
        // Use DB::raw to insert the PostGIS geometry directly
        return DB::raw("ST_GeomFromText('$value', 4326)");
    }
}
