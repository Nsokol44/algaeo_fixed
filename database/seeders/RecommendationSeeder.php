<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Recommendation;

class RecommendationSeeder extends Seeder
{
    public function run(): void
    {
        // WaterSaver – clay + drought
        $waterSaver = Product::where('name', 'Algaeo WaterSaver')->first();
        if ($waterSaver) {
            Recommendation::updateOrCreate(
                ['product_id' => $waterSaver->id],
                [
                    'rank_score'            => 1,
                    'notes'                 => 'For clay soils experiencing drought stress; Scenedesmus produces water-retaining biofilms.',
                    'application_method'    => 'Soil drench or irrigation injection',
                    'application_frequency' => 'Every 3–4 weeks during dry periods',
                    'trial_guidance'        => 'For a 0.1-acre trial bed, use ~0.2 gallons mixed in sufficient water to cover the area evenly.',
                ]
            );
        }

        // Nitrogen+ – leafy greens + yellow leaves
        $nitrogenPlus = Product::where('name', 'Algaeo Nitrogen+')->first();
        if ($nitrogenPlus) {
            Recommendation::updateOrCreate(
                ['product_id' => $nitrogenPlus->id],
                [
                    'rank_score'            => 1,
                    'notes'                 => 'For leafy greens with yellow leaves (nitrogen deficiency); Azospirillum promotes leaf weight and yield.',
                    'application_method'    => 'Fertigation or side-dress via irrigation',
                    'application_frequency' => 'Every 2–3 weeks during active growth',
                    'trial_guidance'        => 'For a 0.1-acre strip of leafy greens, start with 0.1–0.2 gallons in enough water to wet the root zone.',
                ]
            );
        }

        // RootGuard – peaty soils + disease pressure
        $rootGuard = Product::where('name', 'Algaeo RootGuard')->first();
        if ($rootGuard) {
            Recommendation::updateOrCreate(
                ['product_id' => $rootGuard->id],
                [
                    'rank_score'            => 1,
                    'notes'                 => 'For peaty or waterlogged soils with disease pressure; Pseudomonas fluorescens produces antibiotics to suppress pathogens.',
                    'application_method'    => 'Soil drench focused on root zone',
                    'application_frequency' => 'Every 3–4 weeks, especially after heavy rain or flooding events',
                    'trial_guidance'        => 'For a 0.1-acre trial block, apply ~0.2 gallons diluted into enough water to reach the root zone.',
                ]
            );
        }

        // AquaSym – hydroponic systems
        $aquaSym = Product::where('name', 'AquaSym Refresh Kit')->first();
        if ($aquaSym) {
            Recommendation::updateOrCreate(
                ['product_id' => $aquaSym->id],
                [
                    'rank_score'            => 1,
                    'notes'                 => 'For hydroponic systems; Variovorax and Chlorella support signaling and nutrient cycling.',
                    'application_method'    => 'Added directly to the reservoir during refresh',
                    'application_frequency' => 'At each reservoir change or every 2–4 weeks',
                    'trial_guidance'        => 'For a 100-gallon reservoir, start with the labeled refresh dose and monitor biofilm and plant response.',
                ]
            );
        }

        // Default consortium – global fallback
        $consortium = Product::where('name', 'Algaeo Microbe Consortia')->first();
        if ($consortium) {
            Recommendation::updateOrCreate(
                ['product_id' => $consortium->id],
                [
                    'rank_score'            => 0,
                    'notes'                 => 'General-purpose consortium recommended for default or non-specified conditions.',
                    'application_method'    => 'Broadcast via irrigation or soil drench',
                    'application_frequency' => 'Every 3–4 weeks during the growing season',
                    'trial_guidance'        => 'For a 0.1-acre test area, apply ~0.1–0.2 gallons with enough water for even coverage.',
                ]
            );
        }
    }
}
