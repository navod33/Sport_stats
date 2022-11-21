<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileMyProfileAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * Get currently logged in user&#039;s profile
     *
     * @return  void
     */
    public function test_api_profile_get_my_profile()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-access-token'] = $this->getAccessToken();
	                    	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
		
                        $response = $this->get('/api/v1/profile', $headers);
                
        $this->saveResponse($response->getContent(), 'profile_get_my_profile', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
