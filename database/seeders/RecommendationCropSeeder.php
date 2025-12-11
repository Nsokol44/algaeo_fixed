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

        // Make sure these names match your CropSeeder
        $tomato       = Crop::where('name', 'Tomato')->first();
        $leafyGreens  = Crop::where('name', 'Leafy Greens')->first();
        $anyCrop      = Crop::where('name', 'Any crop')->first(); // optional, if you created one

        if ($waterSaver && $tomato) {
            $waterSaver->crops()->syncWithoutDetaching([$tomato->id]);
        }

        if ($nitrogenPlus && $leafyGreens) {
            $nitrogenPlus->crops()->syncWithoutDetaching([$leafyGreens->id]);
        }

        // RootGuard applies broadly to veggies / susceptible crops
        // if "Any crop" or "Vegetable crops" entry, use that here:
        if ($rootGuard && $anyCrop) {
            $rootGuard->crops()->syncWithoutDetaching([$anyCrop->id]);
        }

        // AquaSym is more about system type (hydroponic) than crop,
        // so fine to leave crops empty for it

        // consortium -> default
    }
}
