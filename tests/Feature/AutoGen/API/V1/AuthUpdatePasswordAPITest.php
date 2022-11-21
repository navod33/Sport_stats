<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthUpdatePasswordAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * 
     *
     * @return  void
     */
    public function test_api_auth_post_update_password()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-access-token'] = $this->getAccessToken();
	                    	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
					// form params
                            $data['password'] = '12345678';
                            $data['current_password'] = '12345678';
                            $data['password_confirmation'] = '12345678';
            		
                        $response = $this->post('/api/v1/password/edit', $data, $headers);
                
        $this->saveResponse($response->getContent(), 'auth_post_update_password', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
