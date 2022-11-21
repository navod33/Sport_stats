<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GuestGuestSettingsAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * Guest settings and parameters
     *
     * @return  void
     */
    public function test_api_guest_get_guest_settings()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
		
                        $response = $this->get('/api/v1/guests', $headers);
                
        $this->saveResponse($response->getContent(), 'guest_get_guest_settings', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
