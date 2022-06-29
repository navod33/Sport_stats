<?php

namespace Database\Seeders;

use App\Entities\Seasons\Season;
use ElegantMedia\OxygenFoundation\Database\Seeders\SeedWithoutDuplicates;
use Illuminate\Database\Seeder;

class SeasonsSeeder extends Seeder
{

    use SeedWithoutDuplicates;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Summer 2021'],
            ['name' => 'Summer 2021'],
            ['name' => 'Winter 2022'],
            ['name' => 'Summer 2023'],
        ];

        $this->seedWithoutDuplicates($data, Season::class, 'name', 'name');
    }
}
