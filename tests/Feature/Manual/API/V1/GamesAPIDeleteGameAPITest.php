<?php

namespace Tests\Feature\Manual\API\V1;

use App\Entities\Games\Game;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\AutoGen\API\V1\APIBaseTestCase;
use Tests\Feature\Manual\GetsTestData;

class GamesAPIDeleteGameAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;
    use GetsTestData;

    /**
     *
     *
     *
     * @return  void
     */
    public function test_api_gamesapi_delete_delete_game()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $game = $this->getTestGame();

        $server = $this->transformHeadersToServerVars($headers);
        $cookies = $this->prepareCookiesForRequest();
        $response = $this->call('delete', '/api/v1/games/' . $game->uuid, $data, $cookies, $files, $server, $content);

        $this->saveResponse($response->getContent(), 'gamesapi_delete_delete_game', $response->getStatusCode());

        $response->assertStatus(200);

        // confirm model is deleted
        $this->assertNull(Game::find($game->id));
    }
}
