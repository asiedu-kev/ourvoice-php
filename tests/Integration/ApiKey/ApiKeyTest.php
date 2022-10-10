<?php

namespace Tests\Integration\ApiKey;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use Tests\Integration\BaseTest;

class ApiKeyTest extends BaseTest
{
    public function testListApiKey(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'api-keys', null, null);
        $this->client->apikeys->read();
    }

    public function testViewApiKey(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'api-keys/apikey_id',
            null,
            null
        );
        $this->client->apikeys->read("apikey_id");
    }
    public function testDeleteApiKey(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'api-keys/apikey_id',
            null,
            null
        );
        $this->client->apikeys->delete("apikey_id");
    }
}
