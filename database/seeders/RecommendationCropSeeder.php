<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recommendation;
use App\Models\Crop;

class RecommendationCropSeeder extends Seeder
{
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

        // is category == true 
        $leafyGreens   = Crop::where('name', 'Leafy Greens')
                             ->where('is_category', true)
                             ->first();

        $nightshades   = Crop::where('name', 'Nightshades')
                             ->where('is_category', true)
                             ->first();

        $rootCrops     = Crop::where('name', 'Root Crops')
                             ->where('is_category', true)
                             ->first();

        $cerealsGrains = Crop::where('name', 'Cereals & Grains')
                             ->where('is_category', true)
                             ->first();

        $anyCrop       = Crop::where('name', 'General (Any Crop)')
                             ->where('is_category', false)
                             ->first();

        /*
         * mappings:
         * - WaterSaver - applies to any crop on clay + drought
         * - Nitrogen+. - target Leafy Greens category (lettuce, spinach, kale, etc.)
         * - RootGuard - target Root Crops category
         * - AquaSym - example mapping to Cereals & Grains (or whichever demo category you prefer).
         * - Consortium - stays global or can be tied to "General (Any Crop)".
         */

        if ($nitrogenPlus && $leafyGreens) {
            $nitrogenPlus->crops()->syncWithoutDetaching([$leafyGreens->id]);
        }

        if ($rootGuard && $rootCrops) {
            $rootGuard->crops()->syncWithoutDetaching([$rootCrops->id]);
        }

        if ($aquaSym && $cerealsGrains) {
            $aquaSym->crops()->syncWithoutDetaching([$cerealsGrains->id]);
        }

        // optional: consortium -> explicit "any crop" row
        if ($consortium) {
            $consortium->crops()->detach();
        }

        // WaterSaver intentionally left without crop mapping
        // so it’s keyed only to soil + issue.
    }
}
