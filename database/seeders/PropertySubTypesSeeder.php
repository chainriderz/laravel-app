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
        PropertySubType::upsert(
		    [
		        ['id' => 1, 'property_type_id' => 1, 'name' => 'Flat'],
		        ['id' => 2, 'property_type_id' => 1, 'name' => 'Villa'],
		        ['id' => 3, 'property_type_id' => 1, 'name' => 'Apartment'],
		        ['id' => 4, 'property_type_id' => 2, 'name' => 'Office'],
		        ['id' => 5, 'property_type_id' => 2, 'name' => 'Shop'],
		    ],
		    ['id'],
		    ['name', 'property_type_id']
		);
    }
}
