<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthLogoutAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * Logout the user from current device
     *
     * @return  void
     */
    public function test_api_auth_get_logout()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-access-token'] = $this->getAccessToken();
	                    	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
		
                        $response = $this->get('/api/v1/logout', $headers);
                
        $this->saveResponse($response->getContent(), 'auth_get_logout', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
