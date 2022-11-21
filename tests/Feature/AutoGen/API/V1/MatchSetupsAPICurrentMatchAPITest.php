<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MatchSetupsAPICurrentMatchAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * Get a match details for a time segment
     *
     * @return  void
     */
    public function test_api_matchsetupsapi_get_current_match()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-access-token'] = $this->getAccessToken();
	                    	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
		
                        $response = $this->get('/api/v1/match', $headers);
                
        $this->saveResponse($response->getContent(), 'matchsetupsapi_get_current_match', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
