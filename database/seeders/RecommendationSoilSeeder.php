<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recommendation;
use App\Models\Soil;

class RecommendationSoilSeeder extends Seeder
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

        // find soils by name
        $clay       = Soil::where('name', 'Clay')->first();
        $peaty      = Soil::where('name', 'Peaty')->first();
        $hydroponic = Soil::where('name', 'Hydroponic')->first();

        // attach soils 
        if ($waterSaver && $clay) {
            $waterSaver->soils()->syncWithoutDetaching([$clay->id]);
        }

        // Nitrogen+ has no specific soil restriction -> works on most soils
        // purposely do NOT attach any soil for $nitrogenPlus

        if ($rootGuard && $peaty) {
            $rootGuard->soils()->syncWithoutDetaching([$peaty->id]);
        }

        if ($aquaSym && $hydroponic) {
            $aquaSym->soils()->syncWithoutDetaching([$hydroponic->id]);
        }

        // consortium is a true default -> no soils attached on purpose
    }
}
