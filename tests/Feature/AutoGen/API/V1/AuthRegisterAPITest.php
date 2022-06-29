<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthRegisterAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;

    /**
     *
     * This endpoint registers a user.If you need to update a profile image, upload the profile image in thebackground using `/avatar` endpoint.
     *
     * @return  void
     */
    public function test_api_auth_post_register()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-api-key'] = $this->getApiKey();

        // form params
        $data['device_id'] = $faker->uuid;
        $data['device_type'] = 'apple';
        $data['device_push_token'] = '';
        $data['email'] = $faker->safeEmail;
        $data['password'] = '12345678';
        $data['password_confirmation'] = '12345678';

        $response = $this->post('/api/v1/register', $data, $headers);

        $this->saveResponse($response->getContent(), 'auth_post_register', $response->getStatusCode());

        $response->assertStatus(200);
    }
}
