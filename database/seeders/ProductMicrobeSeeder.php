<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductMicrobeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get product IDs by name
        $waterSaver      = \App\Models\Product::where('name', 'Algaeo WaterSaver')->first();
        $nitrogenPlus    = \App\Models\Product::where('name', 'Algaeo Nitrogen+')->first();
        $rootGuard       = \App\Models\Product::where('name', 'Algaeo RootGuard')->first();
        $aquaSym         = \App\Models\Product::where('name', 'AquaSym Refresh Kit')->first();
        $consortium      = \App\Models\Product::where('name', 'Algaeo Microbe Consortia')->first();
        // get microbe IDs by name
        $chlorella       = \App\Models\Microbe::where('name', 'Chlorella vulgaris')->first();
        $azospirillum    = \App\Models\Microbe::where('name', 'Azospirillum brasilense')->first();
        $bacillus        = \App\Models\Microbe::where('name', 'Bacillus subtilis')->first();
        $scenedesmus     = \App\Models\Microbe::where('name', 'Scenedesmus sp.')->first();
        $pseudomonas     = \App\Models\Microbe::where('name', 'Pseudomonas fluorescens')->first();
        $nannochloropsis = \App\Models\Microbe::where('name', 'Nannochloropsis sp.')->first();
        $variovorax      = \App\Models\Microbe::where('name', 'Variovorax paradoxus')->first();
        $chlorellaHydro  = \App\Models\Microbe::where('name', 'Chlorella vulgaris (Hydroponic)')->first();
        // attach microbes to products
        $waterSaver->microbes()->attach([$scenedesmus->id]);
        $nitrogenPlus->microbes()->attach([$azospirillum->id]);
        $rootGuard->microbes()->attach([$pseudomonas->id, $nannochloropsis->id]);
        $aquaSym->microbes()->attach([$variovorax->id, $bacillus->id, $chlorellaHydro->id]);
        $consortium->microbes()->attach([$chlorella->id, $azospirillum->id, $bacillus->id]);
    }
}
