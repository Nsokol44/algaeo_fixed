<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Microbe;

class MicrobeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Chlorella vulgaris (soil / general)
        Microbe::updateOrCreate(
            ['name' => 'Chlorella vulgaris'],
            [
                'genus'            => 'Chlorella',
                'species'          => 'vulgaris',
                'common_name'      => 'Green microalgae',
                'function_summary' => 'Oxygen producer, nutrient cycler, promotes microbial balance',
                'benefit_tags'     => 'oxygenation,nutrient-cycling',
            ]
        );

        // Azospirillum brasilense
        Microbe::updateOrCreate(
            ['name' => 'Azospirillum brasilense'],
            [
                'genus'            => 'Azospirillum',
                'species'          => 'brasilense',
                'common_name'      => 'Nitrogen-fixing rhizobacteria',
                'function_summary' => 'Nitrogen fixer; promotes root elongation and leaf growth',
                'benefit_tags'     => 'nitrogen-fixing,root-growth,leaf-growth',
            ]
        );

        // Bacillus subtilis
        Microbe::updateOrCreate(
            ['name' => 'Bacillus subtilis'],
            [
                'genus'            => 'Bacillus',
                'species'          => 'subtilis',
                'common_name'      => 'Beneficial Bacillus',
                'function_summary' => 'Phosphate solubilizer; organic matter degrader; biocontrol properties',
                'benefit_tags'     => 'p-solubilizing,biocontrol',
            ]
        );

        // Scenedesmus sp.
        Microbe::updateOrCreate(
            ['name' => 'Scenedesmus sp.'],
            [
                'genus'            => 'Scenedesmus',
                'species'          => 'sp.',
                'common_name'      => 'Green microalgae',
                'function_summary' => 'Produces water-retaining biofilms; increases soil moisture efficiency',
                'benefit_tags'     => 'water-retention,biofilm',
            ]
        );

        // Pseudomonas fluorescens
        Microbe::updateOrCreate(
            ['name' => 'Pseudomonas fluorescens'],
            [
                'genus'            => 'Pseudomonas',
                'species'          => 'fluorescens',
                'common_name'      => 'Fluorescent Pseudomonas',
                'function_summary' => 'Produces natural antibiotics; suppresses fungal pathogens',
                'benefit_tags'     => 'biocontrol,antifungal',
            ]
        );

        // Nannochloropsis sp.
        Microbe::updateOrCreate(
            ['name' => 'Nannochloropsis sp.'],
            [
                'genus'            => 'Nannochloropsis',
                'species'          => 'sp.',
                'common_name'      => 'Marine microalgae',
                'function_summary' => 'Balances microbial community; contributes fatty acids supporting root immunity',
                'benefit_tags'     => 'community-balance,root-health',
            ]
        );

        // Variovorax paradoxus
        Microbe::updateOrCreate(
            ['name' => 'Variovorax paradoxus'],
            [
                'genus'            => 'Variovorax',
                'species'          => 'paradoxus',
                'common_name'      => 'Plant growth-promoting bacterium',
                'function_summary' => 'Produces IAA (auxin); regulates plant-microbe signaling pathways',
                'benefit_tags'     => 'auxin,signaling,growth-promotion',
            ]
        );

        // Chlorella vulgaris (Hydroponic)
        Microbe::updateOrCreate(
            ['name' => 'Chlorella vulgaris (Hydroponic)'],
            [
                'genus'            => 'Chlorella',
                'species'          => 'vulgaris',
                'common_name'      => 'Green microalgae (hydroponic)',
                'function_summary' => 'Enhances oxygenation and nutrient cycling in hydroponic systems',
                'benefit_tags'     => 'hydroponic,oxygenation',
            ]
        );
    }
}
