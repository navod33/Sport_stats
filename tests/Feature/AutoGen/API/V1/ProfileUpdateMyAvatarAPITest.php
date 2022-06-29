<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileUpdateMyAvatarAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;

    /**
     *
     *
     *
     * @return  void
     */
    public function test_api_profile_post_update_my_avatar()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        // form params
        $data['image'] = \Illuminate\Http\UploadedFile::fake()->image('image.jpg');

        $response = $this->post('/api/v1/avatar', $data, $headers);

        $this->saveResponse($response->getContent(), 'profile_post_update_my_avatar', $response->getStatusCode());

        $response->assertStatus(200);
    }
}
