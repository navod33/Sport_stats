<?php

namespace Database\Seeders;

use App\Entities\Games\Game;
use App\Entities\Seasons\Season;
use App\Models\User;
use Illuminate\Database\Seeder;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'apps+user@elegantmedia.com.au')->first();

        // create 10 random games with teams and players
        for ($i = 0; $i < 10; $i++) {
            $game = new Game([
                'tournament_name' => 'Tournament ' . $i,
                'owner_id' => $user->id,
                'played_at' => now()->addDays(rand(0, 100)),
                'season_id' => Season::inRandomOrder()->first()->id,
            ]);

            // assign a random Team owned by this user
            $team = $user->teams()->inRandomOrder()->first();
            $game->team_a()->associate($team);
            $game->save();


        }

    }
}
