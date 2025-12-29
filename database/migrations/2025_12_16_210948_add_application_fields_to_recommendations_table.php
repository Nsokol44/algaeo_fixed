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
        Schema::table('recommendations', function (Blueprint $table) {
            $table->string('application_method')->nullable()->after('notes');
            $table->string('application_frequency')->nullable()->after('application_method');
            $table->text('trial_guidance')->nullable()->after('application_frequency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recommendations', function (Blueprint $table) {
            $table->dropColumn([
                'application_method',
                'application_frequency',
                'trial_guidance',
            ]);
        });
    }
};
