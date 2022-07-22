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
            ['name' => 'Goal Keeper'],
            ['name' => 'Goal Defence'],
            ['name' => 'Wing Defence'],
            ['name' => 'Wing Attack'],
            ['name' => 'Goal Attack'],
            ['name' => 'Goal Shooter'],
        ];

        $this->seedWithoutDuplicates($data, PlayerPosition::class, 'name', 'name');
    }
}
