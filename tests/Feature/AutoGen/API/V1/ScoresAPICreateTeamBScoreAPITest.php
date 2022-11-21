<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScoresAPICreateTeamBScoreAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * Create a new score for team B.
     *
     * @return  void
     */
    public function test_api_scoresapi_post_create_team_b_score()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-access-token'] = $this->getAccessToken();
	                    	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
					// form params
                            $data['gameUuid'] = '';
                            $data['score_type'] = '';
            		
                        $response = $this->post('/api/v1/games/scores/teamb', $data, $headers);
                
        $this->saveResponse($response->getContent(), 'scoresapi_post_create_team_b_score', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
