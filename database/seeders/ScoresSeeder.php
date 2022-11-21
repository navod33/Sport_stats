<?php

namespace Database\Seeders;

use App\Entities\Games\Game;
use App\Entities\Scores\Score;
use Illuminate\Database\Seeder;

class ScoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // see for all games
        $games = Game::all();

        foreach ($games as $game) {
            // see for all players
            $players = $game->team_a->players;
            foreach ($players as $player) {
                $score = new Score();
                $score->game_id = $game->id;
                // get a random position from a list
                $positions = ['Goalkeeper', 'Defender', 'Midfielder', 'Forward'];
                $score->position = $positions[array_rand($positions)];
                $score->player_id = $player->id;
                $score->score = rand(0, 100);
                $score->time_segment = 'Quarter ' . rand(1, 4);
                $score->save();
           }
        }
    }
}
