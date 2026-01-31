<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use Carbon\Carbon;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $areas = \App\Models\Area::pluck('id')->toArray();
        $cities = \App\Models\City::pluck('id')->toArray();
        $types = \App\Models\PropertyType::pluck('id')->toArray();
        $subTypes = \App\Models\PropertySubType::pluck('id')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            Property::create([
                'flat' => 'Flat ' . rand(101, 120),
                'floor' => rand(1, 20),
                'plot' => 'Plot ' . rand(1, 50),
                'bldg_no' => 'B-' . rand(1, 20),
                'bldg_name' => fake()->randomElement([
                    'Fam Society',
                    'Green Valley Apartments',
                    'Sai Krupa Heights',
                    'Blue Moon Towers',
                    'Shiv Shakti Enclave',
                    'Palm Grove Residency',
                    'Crystal Plaza',
                    'Skyline Grande',
                    'Kalash Udyan',
                    'Balaji Garden',
                ]),
                'sector_no' => 'Sector ' . rand(1, 10),
                'landmark' => fake()->randomElement([
                    'Near kopar khairane Station',
                    'kopari gaon',
                    'Behind D-Mart',
                    'Near School',
                    'Close to Highway',
                    'Next to Hospital',
                    'Walking distance from Station',
                ]),

                'area_id' => fake()->randomElement($areas),
                'city_id' => fake()->randomElement($cities),

                'zip' => '400' . rand(100, 999),
                'amount' => fake()->numberBetween(1500000, 9000000),

                'category' => fake()->randomElement(['buy', 'rent']),

                'property_type_id' => fake()->randomElement($types),
                'property_sub_type_id' => fake()->randomElement($subTypes),

                'is_active' => true,

                // expires in 15–90 days
                'active_till' => Carbon::now()->addDays(rand(15, 90)),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
