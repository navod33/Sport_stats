<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthLoginAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * 
     *
     * @return  void
     */
    public function test_api_auth_post_login()
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
                            $data['email'] = 'apps+suadmin@elegantmedia.com.au';
                            $data['password'] = '12345678';
            		
                        $response = $this->post('/api/v1/login', $data, $headers);
                
        $this->saveResponse($response->getContent(), 'auth_post_login', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
