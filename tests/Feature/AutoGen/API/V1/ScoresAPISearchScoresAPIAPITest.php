<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScoresAPISearchScoresAPIAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;

    /**
     *
     * Get a list of scores for a game. Pagination is supported.
     *
     * @return  void
     */
    public function test_api_scoresapi_get_search_scoresapi()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();


        $response = $this->get('/api/v1/games/{gameUuid}/scores', $headers);

        $this->saveResponse($response->getContent(), 'scoresapi_get_search_scoresapi', $response->getStatusCode());

        $response->assertStatus(200);
    }
}
