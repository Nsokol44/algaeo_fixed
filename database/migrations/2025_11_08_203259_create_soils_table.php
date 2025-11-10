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
        Schema::create('soils', function (Blueprint $table) {
            $table->id(); // creates id as pk
            $table->string('name')->unique(); // stores soil name as text
            $table->timestamps(); // adds created_at and updates_at columns automatically
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soils');
    }
};
