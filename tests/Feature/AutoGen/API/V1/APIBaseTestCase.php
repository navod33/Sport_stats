<?php

namespace Tests\Feature\AutoGen\API\V1;

use EMedia\Devices\Auth\DeviceAuthenticator;
use EMedia\Devices\Auth\DeviceNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class APIBaseTestCase extends TestCase
{
    use \EMedia\Api\Domain\Traits\NamesAndPathLocations;

    protected $responseStoragePath;
    protected $saveResponses = false;
    protected $accessToken;

    protected function setUp(): void
    {
        parent::setUp();

        if (env('API_SAVE_TEST_RESPONSES', true)) {
            $this->responseStoragePath = self::getApiResponsesAutoGenDir(true);
            $this->saveResponses = true;
        }
    }

    protected function saveResponse($data, $name, $status = '200', $extension = 'json')
    {
        if (!$this->saveResponses) {
            return false;
        }

        $filePath = $this->responseStoragePath . DIRECTORY_SEPARATOR . "{$name}_{$status}.{$extension}";
        $json = json_encode(json_decode($data, true), JSON_PRETTY_PRINT);
        file_put_contents($filePath, $json);
    }

    protected function getApiKey()
    {
        $key = env('API_KEY', false);

        if (!$key) {
            throw new \Exception("You don't have an active API_KEY on `.env` file.");
        }

        return $key;
    }

    /**
     *
     * Get the x-access-token for the default user
     *
     * @return mixed
     * @throws DeviceNotFoundException
     */
    protected function getAccessToken()
    {
        if ($this->accessToken) {
            return $this->accessToken;
        }

        $testUserId = config('oxygen.api.testUserId', 4);
        $accessToken = DeviceAuthenticator::getAnAccessTokenForUserId($testUserId);

        if (!$accessToken) {
            throw new DeviceNotFoundException("A device not found for the user with ID {$testUserId}. Seed database with at least 1 active device for this user.");
        }

        $this->accessToken = $accessToken;

        return $accessToken;
    }
}
