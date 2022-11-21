<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MatchSetupsAPIMatchSetupUpdateAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * 
     *
     * @return  void
     */
    public function test_api_matchsetupsapi_put_match_setup_update()
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
            		
                        $server = $this->transformHeadersToServerVars($headers);
				$cookies = $this->prepareCookiesForRequest();
                $response = $this->call('put', '/api/v1/match', $data, $cookies, $files, $server, $content);
        
        $this->saveResponse($response->getContent(), 'matchsetupsapi_put_match_setup_update', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
