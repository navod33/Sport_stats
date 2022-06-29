<?php

namespace Tests\Feature\Manual\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\AutoGen\API\V1\APIBaseTestCase;
use Tests\Feature\Manual\GetsTestData;

class ScoresAPIListScoresperGameAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;
    use GetsTestData;

    /**
     *
     * Get a list of scores for a game. Pagination is supported.
     *
     * @return  void
     */
    public function test_api_scoresapi_get_list_scores_per_game()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $game = $this->getTestGame();


        $response = $this->get('/api/v1/games/' . $game->uuid . '/scores', $headers);

        $this->saveResponse($response->getContent(), 'scoresapi_get_list_scores_per_game', $response->getStatusCode());

        $response->assertStatus(200);
    }
}
