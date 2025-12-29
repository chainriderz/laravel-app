<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PropertySubType;

class PropertySubTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertySubType::insert([
		    ['property_type_id' => 1, 'name' => 'Flat'],
		    ['property_type_id' => 1, 'name' => 'Villa'],
		    ['property_type_id' => 1, 'name' => 'Apartment'],
		    ['property_type_id' => 2, 'name' => 'Office Space'],
		    ['property_type_id' => 2, 'name' => 'Shop'],
		    ['property_type_id' => 2, 'name' => 'Godown'],
		]);
    }
}
