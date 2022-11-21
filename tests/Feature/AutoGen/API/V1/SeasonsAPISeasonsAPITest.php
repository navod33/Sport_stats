<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeasonsAPISeasonsAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * 
     *
     * @return  void
     */
    public function test_api_seasonsapi_get_seasons()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-access-token'] = $this->getAccessToken();
	                    	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
		
                        $response = $this->get('/api/v1/seasons', $headers);
                
        $this->saveResponse($response->getContent(), 'seasonsapi_get_seasons', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
