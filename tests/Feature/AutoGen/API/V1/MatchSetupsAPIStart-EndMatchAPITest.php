<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MatchSetupsAPIStart-EndMatchAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * 
     *
     * @return  void
     */
    public function test_api_matchsetupsapi_post_start-end_match()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-access-token'] = $this->getAccessToken();
	                    	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
					// form params
                            $data['game_id'] = '';
                            $data['req_type'] = '';
            		
                        $response = $this->post('/api/v1/match-start', $data, $headers);
                
        $this->saveResponse($response->getContent(), 'matchsetupsapi_post_start-end_match', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
