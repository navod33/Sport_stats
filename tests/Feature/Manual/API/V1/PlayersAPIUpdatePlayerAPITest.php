<?php

namespace Tests\Feature\Manual\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\AutoGen\API\V1\APIBaseTestCase;
use Tests\Feature\Manual\GetsTestData;

class PlayersAPIUpdatePlayerAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;
    use GetsTestData;

    /**
     *
     *
     *
     * @return  void
     */
    public function test_api_playersapi_put_update_player()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $player = $this->getTestPlayer();

        // form params
        $data['name'] = $faker->name;
        $data['email'] = $faker->email;
        // $data['positions'] = '';
        // $data['image_uuid'] = $file->uuid;

        $server = $this->transformHeadersToServerVars($headers);
        $cookies = $this->prepareCookiesForRequest();
        $response = $this->call('put', '/api/v1/players/' . $player->uuid, $data, $cookies, $files, $server, $content);

        $this->saveResponse($response->getContent(), 'playersapi_put_update_player', $response->getStatusCode());

        $response->assertStatus(200);
    }
}
