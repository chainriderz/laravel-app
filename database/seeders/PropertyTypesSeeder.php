<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertyType::upsert(
            [
                ['id' => 1, 'name' => 'All Residential'],
                ['id' => 2, 'name' => 'All Commercial'],
            ],
            ['id'],        // unique key
            ['name']       // columns to update
        );
    }
}
