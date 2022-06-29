<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamsAPIListTeamsAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;

    /**
     *
     * Get a list of teams created by user
     *
     * @return  void
     */
    public function test_api_teamsapi_get_list_teams()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();


        $response = $this->get('/api/v1/teams', $headers);

        $this->saveResponse($response->getContent(), 'teamsapi_get_list_teams', $response->getStatusCode());

        $response->assertStatus(200);
    }
}
