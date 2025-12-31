<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Crop;

class CropSeeder extends Seeder
{
    public function run(): void
    {
        Crop::query()->delete();

        // top level categories & the specific crops under each
        $categories = [
            'Cereals & Grains' => [
                'Wheat',
                'Corn',
            ],
            'Legumes' => [
                'Beans',
                'Peas',
            ],
            'Nightshades' => [
                'Tomato',
                'Pepper',
                'Potato',
            ],
            'Brassicas & Leafy Greens' => [
                'Kale',
                'Lettuce',
                'Spinach',
            ],
            'Cucurbits' => [
                'Cucumber',
            ],
            'Root Crops' => [
                'Carrot',
            ],
            'Herbs' => [
                'Basil',
                'Cilantro',
            ],
            'Other / Any Crop' => [
                'General (Any Crop)',
            ],
            // extra top-level families mentioned in feedvack; no children yet is fine
            'Biofuel & Industrial Crops' => [],
            'Berries & Small Fruits' => [],
            'Fruit, Nut, and Orchard Trees' => [],
        ];

        $categoryRows = [];

        // create all category rows
        foreach ($categories as $categoryName => $children) {
            $categoryRows[$categoryName] = Crop::create([
                'name' => $categoryName,
                'is_category' => true,
                'parent_id' => null,
            ]);
        }

        // create children under each category
        foreach ($categories as $categoryName => $children) {
            $parent = $categoryRows[$categoryName];

            foreach ($children as $childName) {
                Crop::create([
                    'name' => $childName,
                    'is_category' => false,
                    'parent_id' => $parent->id,
                ]);
            }
        }
    }
}
