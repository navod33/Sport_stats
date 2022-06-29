<?php

namespace Tests\Feature\Manual\API\V1;

use App\Entities\Teams\Team;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\AutoGen\API\V1\APIBaseTestCase;
use Tests\Feature\Manual\GetsTestData;

class TeamsAPIDeleteTeamAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;
    use GetsTestData;

    /**
     *
     *
     *
     * @return  void
     */
    public function test_api_teamsapi_delete_delete_team()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        $team = Team::where('owner_id', $this->getTestUser()->id)->get()->first();


        $server = $this->transformHeadersToServerVars($headers);
        $cookies = $this->prepareCookiesForRequest();
        $response = $this->call('delete', '/api/v1/teams/' . $team->uuid, $data, $cookies, $files, $server, $content);

        $this->saveResponse($response->getContent(), 'teamsapi_delete_delete_team', $response->getStatusCode());

        $response->assertStatus(200);

        // confirm model is deleted
        $this->assertNull(Team::find($team->id));
    }
}
