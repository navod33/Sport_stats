<?php

namespace Database\Seeders;

use App\Entities\Teams\Team;
use App\Models\User;
use EMedia\TestKit\Traits\Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeamsSeeder extends Seeder
{

    use Faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::whereIn('email', ['apps+user@elegantmedia.com.au'])->get();

        foreach (['Team A', 'Team B', 'Team C'] as $teamName) {
            foreach ($users as $user) {
                $team = new Team();
                $team->fill([
                    'name' => $teamName,
                    'team_number' => Str::random(5),
                    'player_count' => mt_rand(10, 15),
                    'performance_notes' => $this->getFaker()->sentence,
                    // image_id
                    // metadata
                ]);
                // $team->owner_id = 1;
                $team->owner()->associate($user);
                $team->save();
            }
        }


    }
}
