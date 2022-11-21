<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingsGetSettingsAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * Returns all app settings. Each setting value is identified by the respective key.
     *
     * @return  void
     */
    public function test_api_settings_get_get_settings()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
		
                        $response = $this->get('/api/v1/settings', $headers);
                
        $this->saveResponse($response->getContent(), 'settings_get_get_settings', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
