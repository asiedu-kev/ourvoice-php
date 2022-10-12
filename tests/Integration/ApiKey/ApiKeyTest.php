<?php

namespace Tests\Integration\ApiKey;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use Tests\Integration\BaseTest;
use  Ourvoice\Sdk\Objects\ApiKey;
use  Ourvoice\Sdk\Objects\Account;

class ApiKeyTest extends BaseTest
{

    public function testCreateApiKey(): void
    {
        $account = new Account();
        $apikey = new ApiKey();
        $apikey->type = "John";
        $apikey->description = "Johnhg";
        $apikey->account_id = $account->id;

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "type": "John",
            "description":"Johnhg",
            "account_id": "$account->id",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
            
        }',
        ]);
        
        $this->client->apikeys->create($apikey);
    }

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

    public function testUpdateApiKey(): void
    {
        $this->mockClient
            ->expects($this->exactly(1))->method('performHttpRequest')
            ->withConsecutive(
                ['PUT', 'api-keys/apikey_id', null, '{"type":"fadi"}'],
               
            )
            ->willReturn([200, '', '{}']);

        $apikey = new ApiKey();
        $apikey->type = "fadi" ;
        $this->client->apikeys->update($apikey, 'apikey_id');

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
