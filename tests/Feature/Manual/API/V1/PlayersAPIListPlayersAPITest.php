<?php

namespace Tests\Feature\Manual\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\AutoGen\API\V1\APIBaseTestCase;
use Tests\Feature\Manual\GetsTestData;

class PlayersAPIListPlayersAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;
    use GetsTestData;

    /**
     *
     *
     *
     * @return  void
     */
    public function test_api_playersapi_get_list_players()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $team = $this->getTestTeam();
        validate_all_present($team);
        $data['team_id'] = $team->id;

        $response = $this->get('/api/v1/players?' . http_build_query($data), $headers);

        $this->saveResponse($response->getContent(), 'playersapi_get_list_players', $response->getStatusCode());

        $response->assertStatus(200);
    }
}
