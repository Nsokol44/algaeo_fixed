<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SoilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $soils = [
            ['name' => 'Loamy'],
            ['name' => 'Clay'],
            ['name' => 'Sandy'],
            ['name' => 'Silty'],
            ['name' => 'Peaty'],
            ['name' => 'Chalky'],
            ['name' => 'Hydroponic'],
            ['name' => 'Default / Other'],
        ];

        \App\Models\Soil::insert($soils);
    }
}
