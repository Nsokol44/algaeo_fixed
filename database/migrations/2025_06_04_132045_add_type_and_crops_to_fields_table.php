<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_type_and_crops_to_fields_table.php

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
        Schema::table('fields', function (Blueprint $table) {
            $table->string('type')->after('name')->nullable(); // e.g., 'Field', 'Garden Bed', 'Plot'
            $table->text('crops_grown')->after('type')->nullable(); // Textarea for multiple crops
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fields', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('crops_grown');
        });
    }
};