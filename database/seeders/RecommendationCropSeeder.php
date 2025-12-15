<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecommendationCropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $waterSaver   = Recommendation::whereHas('product', function ($q) {
            $q->where('name', 'Algaeo WaterSaver');
        })->first();

        $nitrogenPlus = Recommendation::whereHas('product', function ($q) {
            $q->where('name', 'Algaeo Nitrogen+');
        })->first();

        $rootGuard    = Recommendation::whereHas('product', function ($q) {
            $q->where('name', 'Algaeo RootGuard');
        })->first();

        $aquaSym      = Recommendation::whereHas('product', function ($q) {
            $q->where('name', 'AquaSym Refresh Kit');
        })->first();

        $consortium   = Recommendation::whereHas('product', function ($q) {
            $q->where('name', 'Algaeo Microbe Consortia');
        })->first();


        $tomato  = Crop::where('name', 'Tomato')->first();
        $lettuce = Crop::where('name', 'Lettuce')->first();
        $spinach = Crop::where('name', 'Spinach')->first();
        $kale    = Crop::where('name', 'Kale')->first();
        $anyCrop = Crop::where('name', 'General (Any Crop)')->first();

        if ($waterSaver && $tomato) {
            $waterSaver->crops()->syncWithoutDetaching([$tomato->id]);
        }

        // Nitrogen+ -> leafy green crops (lettuce, spinach, kale)
        if ($nitrogenPlus) {
            $ids = collect([$lettuce, $spinach, $kale])
                ->filter()          // drop nulls just in case
                ->pluck('id')
                ->all();

            if (!empty($ids)) {
                $nitrogenPlus->crops()->syncWithoutDetaching($ids);
            }
        }

        // RootGuard → broadly for vegetable crops -> use the "General (Any Crop)" 
        if ($rootGuard && $anyCrop) {
            $rootGuard->crops()->syncWithoutDetaching([$anyCrop->id]);
        }

        // consortium -> default
    }
}
