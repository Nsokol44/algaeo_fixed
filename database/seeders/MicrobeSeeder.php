<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MicrobeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $microbes = [
            ['name' => 'Chlorella vulgaris',
            'genus' => 'Chlorella',
            'species' => 'vulgaris',
            'function_summary' => 'Oxygen producer, nutrient cycler, promotes microbial balance',
            'benefit_tags' => 'oxygenation,nutrient-cycling'], 

            ['name' => 'Azospirillum brasilense',
            'genus' => 'Azospirillum',
            'species' => 'brasilense',
            'function_summary' => 'Nitrogen fixer; promotes root elongation and leaf growth',
            'benefit_tags' => 'nitrogen-fixing,root-growth,leaf-growth'],

            ['name' => 'Bacillus subtilis',
            'genus' => 'Bacillus',
            'species' => 'subtilis',
            'function_summary' => 'Phosphate solubilizer; organic matter degrader; biocontrol properties',
            'benefit_tags' => 'p-solubilizing,biocontrol'],

            ['name' => 'Scenedesmus sp.',
            'genus' => 'Scenedesmus',
            'species' => 'sp.',
            'function_summary' => 'Produces water-retaining biofilms; increases soil moisture efficiency',
            'benefit_tags' => 'water-retention,biofilm'],

            ['name' => 'Pseudomonas fluorescens',
            'genus' => 'Pseudomonas',
            'species' => 'fluorescens',
            'function_summary' => 'Produces natural antibiotics; suppresses fungal pathogens',
            'benefit_tags' => 'biocontrol,antifungal'],

            ['name' => 'Nannochloropsis sp.',
            'genus' => 'Nannochloropsis',
            'species' => 'sp.',
            'function_summary' => 'Balances microbial community; contributes fatty acids supporting root immunity',
            'benefit_tags' => 'community-balance,root-health'],

            ['name' => 'Variovorax paradoxus',
            'genus' => 'Variovorax',
            'species' => 'paradoxus',
            'function_summary' => 'Produces IAA (auxin); regulates plant-microbe signaling pathways',
            'benefit_tags' => 'auxin,signaling,growth-promotion'],

            ['name' => 'Chlorella vulgaris (Hydroponic)',
            'genus' => 'Chlorella',
            'species' => 'vulgaris',
            'function_summary' => 'Enhances oxygenation and nutrient cycling in hydroponic systems',
            'benefit_tags' => 'hydroponic,oxygenation'],
        ];

        \App\Models\Microbe::insert($microbes);
    }
}
