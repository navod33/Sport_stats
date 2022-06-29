<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ForgotPasswordResetPasswordAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;

    /**
     *
     *
     *
     * @return  void
     */
    public function test_api_forgotpassword_post_reset_password()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-api-key'] = $this->getApiKey();

        // form params
        $data['email'] = 'apps+suadmin@elegantmedia.com.au';

        $response = $this->post('/api/v1/password/email', $data, $headers);

        $this->saveResponse($response->getContent(), 'forgotpassword_post_reset_password', $response->getStatusCode());

        $response->assertStatus(200);
    }
}
