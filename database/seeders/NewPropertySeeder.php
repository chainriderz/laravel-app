<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NewProject::create([
            'project_name' => 'Aurum Heights',
            'property_type_id' => 1,
            'city_id' => 1,
            'area_id' => 2,
            'builder_name' => 'Aurum Group',
            'rera_number' => 'P51700012345',
            'status' => 'under_construction',
        ]);
    }
}
