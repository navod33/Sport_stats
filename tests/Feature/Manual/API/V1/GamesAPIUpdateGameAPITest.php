<?php

namespace Tests\Feature\Manual\API\V1;

use App\Entities\Seasons\Season;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\AutoGen\API\V1\APIBaseTestCase;
use Tests\Feature\Manual\GetsTestData;

class GamesAPIUpdateGameAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;
    use GetsTestData;

    /**
     *
     *
     *
     * @return  void
     */
    public function test_api_gamesapi_put_update_game()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $game = $this->getTestGame();

        // form params
        $data['tournament_name'] = $faker->sentence;
        $data['played_at'] = now()->toAtomString();
        $data['location'] = $faker->address;
        $data['season_id'] = Season::inRandomOrder()->first()->id;
        $data['team_a_id'] = $game->team_a_id;
        // $data['team_a_image_uuid'] = '';
        // $data['team_b_image_uuid'] = '';
        $data['team_b_name'] = 'Team B';

        $server = $this->transformHeadersToServerVars($headers);
        $cookies = $this->prepareCookiesForRequest();
        $response = $this->call('put', '/api/v1/games/' . $game->uuid, $data, $cookies, $files, $server, $content);

        $this->saveResponse($response->getContent(), 'gamesapi_put_update_game', $response->getStatusCode());

        $response->assertStatus(200);
    }
}
