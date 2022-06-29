<?php

namespace Tests\Feature\Manual;

use App\Entities\Files\File;
use App\Entities\Games\Game;
use App\Entities\Players\Player;
use App\Entities\Teams\Team;
use App\Models\User;

trait GetsTestData
{

    protected function getTestUser()
    {
        return User::find(config('oxygen.api.testUserId', 4));
    }

    protected function getTestFile()
    {
        return File::where('uploaded_by_user_id', $this->getTestUser()->id)->first();
    }

    protected function getTestTeam()
    {
        return Team::where('owner_id', $this->getTestUser()->id)->inRandomOrder()->first();
    }

    protected function getTestPlayer()
    {
        return Player::where('owner_id', $this->getTestUser()->id)->first();
    }

    protected function getTestGame()
    {
        return Game::where('owner_id', $this->getTestUser()->id)->inRandomOrder()->first();
    }

}
