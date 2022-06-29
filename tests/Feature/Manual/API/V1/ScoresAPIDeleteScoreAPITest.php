<?php

namespace Tests\Feature\Manual\API\V1;

use App\Entities\Scores\Score;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\AutoGen\API\V1\APIBaseTestCase;
use Tests\Feature\Manual\GetsTestData;

class ScoresAPIDeleteScoreAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;
    use GetsTestData;

    /**
     *
     * Delete a score record.
     *
     * @return  void
     */
    public function test_api_scoresapi_delete_delete_score()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $game = $this->getTestGame();
        $score = $game->scores()->first();

        $server = $this->transformHeadersToServerVars($headers);
        $cookies = $this->prepareCookiesForRequest();
        $response = $this->call('delete', '/api/v1/games/' . $game->uuid . '/scores/' . $score->uuid, $data, $cookies, $files, $server, $content);

        $this->saveResponse($response->getContent(), 'scoresapi_delete_delete_score', $response->getStatusCode());

        $response->assertStatus(200);

        // confirm model is deleted
        $this->assertNull(Score::find($score->id));
    }
}
