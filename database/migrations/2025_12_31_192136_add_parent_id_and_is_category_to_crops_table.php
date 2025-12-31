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
        Schema::table('crops', function (Blueprint $table) {
            // parent crop
            $table->foreignId('parent_id')
                ->nullable()
                ->after('id')
                ->constrained('crops')
                ->nullOnDelete();
            
            // flag to say this row is a top level category 
            $table->boolean('is_category')
                ->default(false)
                ->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crops', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn(['parent_id', 'is_category']);
        });
    }
};
