<?php

namespace Tests\Feature\Manual\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\AutoGen\API\V1\APIBaseTestCase;
use Tests\Feature\Manual\GetsTestData;
use Tests\Feature\Manual\GetsUsers;

class TeamsAPICreateTeamAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;
    use GetsTestData;

    /**
     *
     *
     *
     * @return  void
     */
    public function test_api_teamsapi_post_create_team()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $user = $this->getTestUser();
        $file = $this->getTestFile();

        // form params
        $data['name'] = $faker->company;
        $data['team_number'] = mt_rand(10,15);
        $data['player_count'] = mt_rand(10, 15);
        $data['image_uuid'] = $file->uuid;

        $response = $this->post('/api/v1/teams', $data, $headers);

        $this->saveResponse($response->getContent(), 'teamsapi_post_create_team', $response->getStatusCode());

        $response->assertStatus(200);
    }

    /**
     *
     *
     *
     * @return  void
     */
    public function test_api_teamsapi_post_create_team_without_files()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $user = $this->getTestUser();
        $file = $this->getTestFile();

        // form params
        $data['name'] = $faker->company;
        $data['team_number'] = mt_rand(10,15);
        $data['player_count'] = mt_rand(10, 15);
        // $data['image_uuid'] = $file->uuid;

        $response = $this->post('/api/v1/teams', $data, $headers);

        $this->saveResponse($response->getContent(), 'teamsapi_post_create_team', $response->getStatusCode());

        $response->assertStatus(200);
    }
}
