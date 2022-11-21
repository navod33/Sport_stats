<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayersAPICreateTeamandPlayersAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * 
     *
     * @return  void
     */
    public function test_api_playersapi_post_create_team_and_players()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-access-token'] = $this->getAccessToken();
	                    	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
					// form params
                            $data['team_name'] = '';
                            $data['team_number'] = '';
                            $data['player_count'] = '';
                            $data['team_image_uuid'] = '';
                            $data['players'] = '';
            		
                        $response = $this->post('/api/v1/players', $data, $headers);
                
        $this->saveResponse($response->getContent(), 'playersapi_post_create_team_and_players', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
