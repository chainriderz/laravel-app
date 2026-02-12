<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewProperty;
use Carbon\Carbon;

class NewPropertySeeder extends Seeder
{
    public function run(): void
    {
        $areas = \App\Models\Area::pluck('id')->toArray();
        $cities = \App\Models\City::pluck('id')->toArray();
        $types = \App\Models\PropertyType::pluck('id')->toArray();
        $subTypes = \App\Models\PropertySubType::pluck('id')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            NewProperty::create([
                'project_name' => fake()->randomElement([
                    'Fam Society v2',
                    'Green Valley Apartments v2',
                    'Sai Krupa Heights v2',
                    'Blue Moon Towers v2',
                    'Shiv Shakti Enclave v2',
                    'Palm Grove Residency v2',
                    'Crystal Plaza v2',
                    'Skyline Grande v2',
                    'Kalash Udyan v2',
                    'Balaji Garden v2',
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
                'builder_name' => fake()->randomElement([
                    'L&T',
                    'Gami',
                    'Kolte Patil',
                    'Atlantis',
                    'Aurum'
                ]),
                'rera_number' => 'A031332501379',
                'launch_date' => Carbon::now()->addDays(rand(15, 90)),
                'possession_date' => Carbon::now()->addDays(rand(90, 180)),
                'status' => fake()->randomElement(['upcoming', 'under_construction', 'ready']),
                'property_type_id' => fake()->randomElement($types),
                'property_sub_type_id' => fake()->randomElement($subTypes),
                'area_id' => fake()->randomElement($areas),
                'city_id' => fake()->randomElement($cities),
                'bhk' => '1, 2, 3 bhk',
                'amount' => '1.02 cr',
                'showtohome' => '1',
                'description' => fake()->text(),
                'is_active' => true,
                'active_till' => Carbon::now()->addDays(rand(15, 90)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
