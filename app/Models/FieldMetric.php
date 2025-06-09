<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FieldMetric extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'field_metrics';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'field_id',
        'metric_type', // e.g., 'growth_rate', 'nitrogen', 'phosphorus', 'potassium', 'temperature', 'precipitation'
        'value',
        'unit',
        'recorded_at',
    ];

    // Define attribute casting for common data types
    protected $casts = [
        'recorded_at' => 'datetime', // Cast 'recorded_at' to a Carbon datetime object
        'value' => 'float',          // Cast 'value' to a float
    ];

    /**
     * Get the field that owns the metric.
     * Defines a many-to-one relationship with the Field model.
     */
    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }
}
