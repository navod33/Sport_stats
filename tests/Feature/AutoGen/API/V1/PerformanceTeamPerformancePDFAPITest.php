<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PerformanceTeamPerformancePDFAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * Get the team porformance PDF link from permalink param of the response
     *
     * @return  void
     */
    public function test_api_performance_get_team_performance_pdf()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-access-token'] = $this->getAccessToken();
	                    	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
		
                        $response = $this->get('/api/v1/team-performance-pdf', $headers);
                
        $this->saveResponse($response->getContent(), 'performance_get_team_performance_pdf', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
