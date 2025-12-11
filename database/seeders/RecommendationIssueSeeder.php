<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecommendationIssueSeeder extends Seeder
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

        // IMPORTANT: make these match your IssueSeeder names exactly
        $drought      = Issue::where('name', 'Drought stress')->first();
        $yellowLeaves = Issue::where('name', 'Yellow leaves / N deficiency')->first();
        $disease      = Issue::where('name', 'Disease pressure')->first();
        $hydroRefresh = Issue::where('name', 'Hydroponic system refresh')->first();

        if ($waterSaver && $drought) {
            $waterSaver->issues()->syncWithoutDetaching([$drought->id]);
        }

        if ($nitrogenPlus && $yellowLeaves) {
            $nitrogenPlus->issues()->syncWithoutDetaching([$yellowLeaves->id]);
        }

        if ($rootGuard && $disease) {
            $rootGuard->issues()->syncWithoutDetaching([$disease->id]);
        }

        if ($aquaSym && $hydroRefresh) {
            $aquaSym->issues()->syncWithoutDetaching([$hydroRefresh->id]);
        }

        // consortium -> default
    }
}
