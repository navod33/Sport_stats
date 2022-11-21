<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResultListMatchResultsAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * Get a list of finished games created by user. Pagination is supported. Played at time is in UTC. Convert to your timezone before using.
     *
     * @return  void
     */
    public function test_api_result_get_list_match_results()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-access-token'] = $this->getAccessToken();
	                    	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
		
                        $response = $this->get('/api/v1/match-result', $headers);
                
        $this->saveResponse($response->getContent(), 'result_get_list_match_results', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
