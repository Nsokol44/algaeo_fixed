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
        Schema::create('microbes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('genus');
            $table->string('species');
            $table->text('function_summary')->nullable();
            $table->string('benefit_tags')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('microbes');
    }
};
