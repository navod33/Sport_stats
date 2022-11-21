<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayersAPIListPlayersPositionsAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * 
     *
     * @return  void
     */
    public function test_api_playersapi_get_list_players_positions()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-access-token'] = $this->getAccessToken();
	                    	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
		
                        $response = $this->get('/api/v1/player-positions', $headers);
                
        $this->saveResponse($response->getContent(), 'playersapi_get_list_players_positions', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
