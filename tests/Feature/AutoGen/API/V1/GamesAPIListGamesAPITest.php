<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GamesAPIListGamesAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;

    /**
     *
     * Get a list of games created by user. Pagination is supported. Played at time is in UTC. Convert to your timezone before using.
     *
     * @return  void
     */
    public function test_api_gamesapi_get_list_games()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();


        $response = $this->get('/api/v1/games', $headers);

        $this->saveResponse($response->getContent(), 'gamesapi_get_list_games', $response->getStatusCode());

        $response->assertStatus(200);
    }
}
