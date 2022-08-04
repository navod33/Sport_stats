<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Entities\PlayerPositions\PlayerPosition;
use ElegantMedia\OxygenFoundation\Database\Seeders\SeedWithoutDuplicates;

class PlayerPositionsSeeder extends Seeder
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
            ['name' => 'Goal Keeper','short_name' => 'GK'],
            ['name' => 'Goal Defence','short_name' => 'GD'],
            ['name' => 'Wing Defence','short_name' => 'WD'],
            ['name' => 'Wing Attack','short_name' => 'WA'],
            ['name' => 'Goal Attack','short_name' => 'GA'],
            ['name' => 'Goal Shooter','short_name' => 'GS'],
            ['name' => 'Center','short_name' => 'C'],
        ];

        $this->seedWithoutDuplicates($data, PlayerPosition::class, 'name', 'name');
    }
}
