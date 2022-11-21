<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PerformanceTeamPerformanceCommentAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * Store the tesm porformance comment
     *
     * @return  void
     */
    public function test_api_performance_post_team_performance_comment()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-access-token'] = $this->getAccessToken();
	                    	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
					// form params
                            $data['team_id'] = '';
                            $data['comment'] = '';
            		
                        $response = $this->post('/api/v1/team-performance-comment', $data, $headers);
                
        $this->saveResponse($response->getContent(), 'performance_post_team_performance_comment', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
