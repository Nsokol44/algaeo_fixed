<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('field_metrics', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('field_id')->constrained()->onDelete('cascade'); // Foreign key to fields table, deletes metrics if field is deleted
            $table->string('metric_type'); // Stores the type of metric (e.g., 'growth_rate', 'nitrogen', 'temperature')
            $table->float('value');       // Stores the numerical value of the metric
            $table->string('unit')->nullable(); // Stores the unit of the metric (e.g., '%', 'ppm', '°F', 'inches')
            $table->timestamp('recorded_at'); // The date and time the metric was recorded
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_metrics');
    }
};