<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $crops = [
            ['name' => 'Lettuce'],
            ['name' => 'Spinach'],
            ['name' => 'Kale'],
            ['name' => 'Tomato'],
            ['name' => 'Cucumber'],
            ['name' => 'Pepper'],
            ['name' => 'Carrot'],
            ['name' => 'Potato'],
            ['name' => 'Beans'],
            ['name' => 'Peas'],
            ['name' => 'Basil'],
            ['name' => 'Cilantro'],
            ['name' => 'Wheat'],
            ['name' => 'Corn'],
            ['name' => 'General (Any Crop)'],
        ];

        \App\Models\Crop::insert($crops);
    }
}
