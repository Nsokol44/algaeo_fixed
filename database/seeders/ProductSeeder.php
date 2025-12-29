<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Algaeo WaterSaver
        Product::updateOrCreate(
            ['name' => 'Algaeo WaterSaver'],
            [
                'slug'        => 'algaeo-watersaver',
                'category'    => 'Culture',
                'description' => 'Biofilm-forming microalgae designed to increase soil moisture retention in clay soils.',
                'dosing_rate' => '2 gallons per acre',
            ]
        );

        // Algaeo Nitrogen+
        Product::updateOrCreate(
            ['name' => 'Algaeo Nitrogen+'],
            [
                'slug'        => 'algaeo-nitrogen-plus',
                'category'    => 'Culture',
                'description' => 'Nitrogen-fixing Spirulina blend designed to address yellowing leaves and nitrogen deficiency in leafy greens.',
                'dosing_rate' => '1–2 gallons per acre (per label guidance)',
            ]
        );

        // Algaeo RootGuard
        Product::updateOrCreate(
            ['name' => 'Algaeo RootGuard'],
            [
                'slug'        => 'algaeo-rootguard',
                'category'    => 'Culture',
                'description' => 'Biocontrol-focused blend designed for fungal suppression in waterlogged or peaty soils.',
                'dosing_rate' => '1 gallon per acre as soil drench',
            ]
        );

        // AquaSym Refresh Kit (hydroponics)
        Product::updateOrCreate(
            ['name' => 'AquaSym Refresh Kit'],
            [
                'slug'        => 'aquasym-refresh-kit',
                'category'    => 'Refresh Kit',
                'description' => 'Hydroponic-friendly microbe–algae pairing to stabilize biofilms and maintain oxygen/nutrient cycling.',
                'dosing_rate' => 'Per reservoir refresh (e.g., 1–2 L per 100-gallon tank)',
            ]
        );

        // Algaeo Microbe Consortia (default blend)
        Product::updateOrCreate(
            ['name' => 'Algaeo Microbe Consortia'],
            [
                'slug'        => 'algaeo-microbe-consortia',
                'category'    => 'Consortium',
                'description' => 'General-purpose blend combining algae, nitrogen-fixers, and Bacillus for overall plant health.',
                'dosing_rate' => '1 gallon per acre as broadcast or irrigation injection',
            ]
        );

        // Standalone Bacillus product
        Product::updateOrCreate(
            ['name' => 'Bacillus subtilis (standalone culture)'],
            [
                'slug'        => 'bacillus-subtilis-standalone',
                'category'    => 'Culture',
                'description' => 'Standalone Bacillus subtilis culture for targeted root-zone and seed treatment.',
                'dosing_rate' => '0.5–1 gallon per acre as seed or in-furrow treatment',
            ]
        );
    }
}
