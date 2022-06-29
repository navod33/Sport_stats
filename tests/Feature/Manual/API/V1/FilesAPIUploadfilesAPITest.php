<?php

namespace Tests\Feature\Manual\API\V1;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\AutoGen\API\V1\APIBaseTestCase;

class FilesAPIUploadfilesAPITest extends APIBaseTestCase
{
    use DatabaseTransactions;

    /**
     *
     * Use this endpoint to upload all files, including player images. You must use the `uuid` that gets returned, and use it to attach the file to other objects.
     *
     * @return  void
     */
    public function test_api_filesapi_post_upload_files()
    {
        $data = $cookies = $files = $headers = $server = [];
        $faker = \Faker\Factory::create('en_AU');
        $content = null;

        // header params
        $headers['Accept'] = 'application/json';
        $headers['x-access-token'] = $this->getAccessToken();
        $headers['x-api-key'] = $this->getApiKey();

        // form params
        $data['file'] = \Illuminate\Http\UploadedFile::fake()->image('image.jpg');

        $response = $this->post('/api/v1/files', $data, $headers);

        $this->saveResponse($response->getContent(), 'filesapi_post_upload_files', $response->getStatusCode());

        $response->assertStatus(200);
    }
}
