<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MatchSetupsAPIMatchSetupAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * 
     *
     * @return  void
     */
    public function test_api_matchsetupsapi_post_match_setup()
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
                            $data['team_id'] = '';
                            $data['players'] = '';
            		
                        $response = $this->post('/api/v1/match', $data, $headers);
                
        $this->saveResponse($response->getContent(), 'matchsetupsapi_post_match_setup', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
