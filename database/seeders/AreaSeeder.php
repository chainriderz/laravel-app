<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Area::upsert(
            [
                ['id' => 1, 'name' => 'Kopar Khairane'],
                ['id' => 2, 'name' => 'Ghansoli'],
                ['id' => 3, 'name' => 'Airoli'],
                ['id' => 4, 'name' => 'Rabale'],
            ],
            ['id'],
            ['name']
        );
    }
}
