<?php

namespace Tests\Feature\Manual\API\V1;

use App\Entities\Scores\Score;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\AutoGen\API\V1\APIBaseTestCase;
use Tests\Feature\Manual\GetsTestData;

class ScoresAPICreateScoreAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;
    use GetsTestData;

    /**
     *
     * Create a new score for a player. Each record will be unique by `gameUuid`, `player_id` and `time_segment`. If the record already exists, it will be updated. If a score record must be deleted, you should send a null score value or use delete endpoint.
     *
     * @return  void
     */
    public function test_api_scoresapi_post_create_score()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $game = $this->getTestGame();
        $player = $game->team_a->players()->inRandomOrder()->first();

        // form params
        $data['player_id'] = $player->id;
        $data['position'] = 'Center';
        $data['time_segment'] = 'Q1';
        $data['score'] = $faker->numberBetween(0, 100);

        $response = $this->post('/api/v1/games/' . $game->uuid . '/scores', $data, $headers);

        $this->saveResponse($response->getContent(), 'scoresapi_post_create_score', $response->getStatusCode());

        $response->assertStatus(200);
    }

    public function test_api_scoresapi_post_create_score_sending_duplicates_updates_record()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $game = $this->getTestGame();
        $player = $game->team_a->players()->inRandomOrder()->first();

        // form params
        $data['player_id'] = $player->id;
        $data['position'] = 'Center';
        $data['time_segment'] = 'Q1';
        $data['score'] = $faker->numberBetween(0, 100);

        $response = $this->post('/api/v1/games/' . $game->uuid . '/scores', $data, $headers);

        $response->assertStatus(200);

        $response = $this->post('/api/v1/games/' . $game->uuid . '/scores', $data, $headers);

        $this->saveResponse($response->getContent(), 'scoresapi_post_create_score_sending_duplicates_updates_record', $response->getStatusCode());

        $response->assertStatus(200);

        // this should create only 1 record and it must have the last score
        $scores = Score::where('game_id', $game->id)
                       ->where('player_id', $player->id)
                       ->where('position', $data['position'])
                       ->where('time_segment', $data['time_segment'])
                       ->get();

        $this->assertEquals(1, $scores->count());
        $this->assertEquals($data['score'], $scores->first()->score);
    }

    public function test_api_scoresapi_post_create_score_null_score_deletes_record()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $game = $this->getTestGame();
        $player = $game->team_a->players()->inRandomOrder()->first();

        // form params
        $data['player_id'] = $player->id;
        $data['position'] = 'Center';
        $data['time_segment'] = 'Q1';
        // $data['score'] = $faker->numberBetween(0, 100);

        $response = $this->post('/api/v1/games/' . $game->uuid . '/scores', $data, $headers);

        $this->saveResponse($response->getContent(), 'scoresapi_post_create_score_null_score_deletes_record', $response->getStatusCode());

        $response->assertStatus(200);

        $this->assertDatabaseMissing('scores', [
            'game_id' => $game->id,
            'player_id' => $player->id,
            'position' => 'Center',
            'time_segment' => 'Q1',
        ]);
    }
}
