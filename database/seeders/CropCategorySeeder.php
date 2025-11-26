<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CropCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Leafy Greens'],
            ['name' => 'Fruit Vegetables'],
            ['name' => 'Root Vegetables'],
            ['name' => 'Legumes'],
            ['name' => 'Herbs'],
            ['name' => 'Grains'],
            ['name' => 'Other'],
        ];

        \App\Models\CropCategory::insert($categories);
    }
}
