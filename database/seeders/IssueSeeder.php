<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $issues = [
            ['name' => 'Yellow Leaves (Chlorosis)'],
            ['name' => 'Root Rot / Fungal Pressure'],
            ['name' => 'Nutrient Deficiency (General)'],
            ['name' => 'Drought Stress'],
            ['name' => 'Poor Growth / Low Vigor'],
            ['name' => 'Salt Stress'],
            ['name' => 'Disease Pressure'],
            ['name' => 'No Specific Issue'],
        ];

        \App\Models\Issue::insert($issues);
    }
}
