<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::upsert(
            [
                ['id' => 1, 'name' => 'Mumbai'],
                ['id' => 2, 'name' => 'Navi Mumbai'],
            ],
            ['id'],
            ['name']
        );
    }
}
