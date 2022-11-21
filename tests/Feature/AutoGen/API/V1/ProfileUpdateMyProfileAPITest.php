<?php

namespace Tests\Feature\AutoGen\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileUpdateMyProfileAPITest extends APIBaseTestCase
{

	use DatabaseTransactions;

    /**
     *
     * 
     *
     * @return  void
     */
    public function test_api_profile_put_update_my_profile()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

					// header params
	        	            	                    $headers['Accept'] = 'application/json';
	            	        	            	                    $headers['x-access-token'] = $this->getAccessToken();
	                    	        	            	                    $headers['x-api-key'] = $this->getApiKey();
	                    	        		
					// form params
                            $data['first_name'] = $faker->firstName;
                            $data['last_name'] = '';
                            $data['email'] = 'apps+suadmin@elegantmedia.com.au';
                            $data['phone'] = '';
            		
                        $server = $this->transformHeadersToServerVars($headers);
				$cookies = $this->prepareCookiesForRequest();
                $response = $this->call('put', '/api/v1/profile', $data, $cookies, $files, $server, $content);
        
        $this->saveResponse($response->getContent(), 'profile_put_update_my_profile', $response->getStatusCode());

		$response->assertStatus(200);
    }

}
