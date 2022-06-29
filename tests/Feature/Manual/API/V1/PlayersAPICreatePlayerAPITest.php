<?php

namespace Tests\Feature\Manual\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\AutoGen\API\V1\APIBaseTestCase;
use Tests\Feature\Manual\GetsTestData;

class PlayersAPICreatePlayerAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;
    use GetsTestData;

    /**
     *
     *
     *
     * @return  void
     */
    public function test_api_playersapi_post_create_player()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $file = $this->getTestFile();
        $team = $this->getTestTeam();

        // form params
        $data['name'] = $faker->name;
        $data['email'] = $faker->email;
        // $data['positions'] = '';
        $data['image_uuid'] = $file->uuid;
        $data['team_id'] = $team->id;

        $response = $this->post('/api/v1/players', $data, $headers);

        $this->saveResponse($response->getContent(), 'playersapi_post_create_player', $response->getStatusCode());

        $response->assertStatus(200);
    }


    /**
     *
     *
     *
     * @return  void
     */
    public function test_api_playersapi_post_create_player_without_team()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $file = $this->getTestFile();
        $team = $this->getTestTeam();

        // form params
        $data['name'] = $faker->name;
        $data['email'] = $faker->email;
        // $data['positions'] = '';
        $data['image_uuid'] = $file->uuid;
        // $data['team_id'] = $team->id;

        $response = $this->post('/api/v1/players', $data, $headers);

        $this->saveResponse($response->getContent(), 'playersapi_post_create_player', $response->getStatusCode());

        $response->assertStatus(422);
    }
}
