<?php

namespace Tests\Feature\Manual\API\V1;

use App\Entities\Players\Player;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\AutoGen\API\V1\APIBaseTestCase;
use Tests\Feature\Manual\GetsTestData;

class PlayersAPIDeletePlayerAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;
    use GetsTestData;

    /**
     *
     *
     *
     * @return  void
     */
    public function test_api_playersapi_delete_delete_player()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $player = $this->getTestPlayer();


        $server = $this->transformHeadersToServerVars($headers);
        $cookies = $this->prepareCookiesForRequest();
        $response = $this->call('delete', '/api/v1/players/' . $player->uuid, $data, $cookies, $files, $server, $content);

        $this->saveResponse($response->getContent(), 'playersapi_delete_delete_player', $response->getStatusCode());

        $response->assertStatus(200);

        // confirm model is deleted
        $this->assertNull(Player::find($player->id));
    }
}
