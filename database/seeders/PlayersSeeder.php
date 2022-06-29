<?php

namespace Database\Seeders;

use App\Entities\Players\Player;
use App\Entities\Teams\Team;
use EMedia\TestKit\Traits\Faker;
use Illuminate\Database\Seeder;

class PlayersSeeder extends Seeder
{

    use Faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = Team::all();

        foreach ($teams as $team) {
            foreach (range(1, 5) as $i) {
                $player = new Player();
                $player->fill([
                    'name' => $this->getFaker()->name,
                    'email' => $this->getFaker()->email,
                    'positions' => 'AB,CD,EF',
                    // image_uuid
                    // metadata
                    'performance_notes' => $this->getFaker()->sentence,
                ]);
                $player->owner()->associate($team->owner);
                $player->team()->associate($team);
                $player->save();
            }
        }
    }
}
