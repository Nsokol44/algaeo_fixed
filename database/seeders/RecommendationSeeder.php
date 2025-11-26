<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // fetch product IDs
        $waterSaver   = \App\Models\Product::where('name', 'Algaeo WaterSaver')->first();
        $nitrogenPlus = \App\Models\Product::where('name', 'Algaeo Nitrogen+')->first();
        $rootGuard    = \App\Models\Product::where('name', 'Algaeo RootGuard')->first();
        $aquaSym      = \App\Models\Product::where('name', 'AquaSym Refresh Kit')->first();
        $consortium   = \App\Models\Product::where('name', 'Algaeo Microbe Consortia')->first();

        $recommendations = [
            ['product_id' => $waterSaver->id,
            'rank_score' => 1,
            'notes' => 'For clay soils experiencing drought stress; Scenedesmus produces water-retaining biofilms.'],

            ['product_id' => $nitrogenPlus->id,
            'rank_score' => 1,
            'notes' => 'For leafy greens with yellow leaves (nitrogen deficiency); Azospirillum promotes leaf weight and yield.'],

            ['product_id' => $rootGuard->id,
            'rank_score' => 1,
            'notes' => 'For peaty soils with disease pressure; Pseudomonas fluorescens produces antibiotics to suppress pathogens.'],

            ['product_id' => $aquaSym->id,
            'rank_score' => 1,
            'notes' => 'For hydroponic systems; Variovorax and Chlorella support signaling and nutrient cycling.'],

            ['product_id' => $consortium->id,
            'rank_score' => 0,
            'notes' => 'General-purpose consortium recommended for default or non-specified conditions.'],
        ];
        \App\Models\Recommendation::insert($recommendations);
    }
}
