<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Field; // Ensure this model is imported
use App\Models\FieldMetric; // Ensure this model is imported
use Carbon\Carbon;

class FieldMetricsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all existing fields to associate metrics with them
        $fields = Field::all();

        // Iterate over each field
        foreach ($fields as $field) {
            // Generate 60 days of dummy data for each metric type for the current field
            for ($i = 0; $i < 60; $i++) {
                $date = Carbon::now()->subDays(60 - $i); // Calculate the date for the current iteration

                // Create a dummy Growth Rate metric
                FieldMetric::create([
                    'field_id' => $field->id,
                    'metric_type' => 'growth_rate',
                    'value' => rand(50, 200) / 10, // Value between 5.0 and 20.0 (e.g., %)
                    'unit' => '%',
                    'recorded_at' => $date,
                ]);

                // Create dummy Nitrogen (N) metric
                FieldMetric::create([
                    'field_id' => $field->id,
                    'metric_type' => 'nitrogen',
                    'value' => rand(30, 80), // Value between 30 and 80 (e.g., ppm)
                    'unit' => 'ppm',
                    'recorded_at' => $date,
                ]);

                // Create dummy Phosphorus (P) metric
                FieldMetric::create([
                    'field_id' => $field->id,
                    'metric_type' => 'phosphorus',
                    'value' => rand(15, 45), // Value between 15 and 45 (e.g., ppm)
                    'unit' => 'ppm',
                    'recorded_at' => $date,
                ]);

                // Create dummy Potassium (K) metric
                FieldMetric::create([
                    'field_id' => $field->id,
                    'metric_type' => 'potassium',
                    'value' => rand(25, 70), // Value between 25 and 70 (e.g., ppm)
                    'unit' => 'ppm',
                    'recorded_at' => $date,
                ]);

                // Create dummy Temperature metric
                FieldMetric::create([
                    'field_id' => $field->id,
                    'metric_type' => 'temperature',
                    'value' => rand(60, 95), // Value between 60 and 95 (e.g., °F)
                    'unit' => '°F',
                    'recorded_at' => $date,
                ]);

                // Create dummy Precipitation metric
                FieldMetric::create([
                    'field_id' => $field->id,
                    'metric_type' => 'precipitation',
                    'value' => rand(0, 100) / 100, // Value between 0.00 and 1.00 (e.g., inches)
                    'unit' => 'inches',
                    'recorded_at' => $date,
                ]);
            }
        }
    }
}