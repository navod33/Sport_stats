<?php

namespace Tests\Feature\Manual\API\V1;

use App\Entities\Seasons\Season;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\AutoGen\API\V1\APIBaseTestCase;
use Tests\Feature\Manual\GetsTestData;

class GamesAPICreateGameAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;
    use GetsTestData;

    /**
     *
     *
     *
     * @return  void
     */
    public function test_api_gamesapi_post_create_game()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $team = $this->getTestTeam();

        // form params
        $data['tournament_name'] = $faker->sentence;
        $data['played_at'] = now()->toAtomString();
        $data['location'] = $faker->address;
        $data['season_id'] = Season::inRandomOrder()->first()->id;
        $data['team_a_id'] = $team->id;
        // $data['team_a_image_uuid'] = '';
        // $data['team_b_image_uuid'] = '';
        $data['team_b_name'] = 'Team B';

        $response = $this->post('/api/v1/games', $data, $headers);

        $this->saveResponse($response->getContent(), 'gamesapi_post_create_game', $response->getStatusCode());

        $response->assertStatus(200);
    }
}
