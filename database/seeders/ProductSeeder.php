<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Algaeo WaterSaver',
            'category' => 'Culture',
            'description' => 'Biofilm-forming microalgae designed to increase soil moisture retention in clay soils.'],

            ['name' => 'Algaeo Nitrogen+',
            'category' => 'Culture',
            'description' => 'Nitrogen-fixing Spirulina blend designed to address yellowing leaves and nitrogen deficiency in leafy greens.'],

            ['name' => 'Algaeo RootGuard',
            'category' => 'Culture',
            'description' => 'Biocontrol-focused blend designed for fungal suppression in waterlogged or peaty soils.'],

            ['name' => 'AquaSym Refresh Kit',
            'category' => 'Refresh Kit',
            'description' => 'Hydroponic-friendly microbe–algae pairing to stabilize biofilms and maintain oxygen/nutrient cycling.'],

            ['name' => 'Algaeo Microbe Consortia',
            'category' => 'Consortium',
            'description' => 'General-purpose blend combining algae, nitrogen-fixers, and Bacillus for overall plant health.'],
        ];

        \App\Models\Product::insert($products);
    }
}
