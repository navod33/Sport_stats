<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingsGetSettingAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * Returns the value of a single app setting requested by key.
     *
     * @return  void
     */
    public function test_api_settings_get_get_setting()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-access-token'] = $this->getAccessToken();
	                    	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
		
                        $response = $this->get('/api/v1/settings/{key}', $headers);
                
        $this->saveResponse($response->getContent(), 'settings_get_get_setting', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
