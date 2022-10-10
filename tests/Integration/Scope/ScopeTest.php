<?php

namespace Tests\Integration\Scope;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use  Ourvoice\Sdk\Objects\Scope;
use Tests\Integration\BaseTest;

class ScopeTest extends BaseTest
{

    public function testCreateScope(): void
    {
       

        $scope = new Scope();
        $scope->name = "John";
        $scope->description = "description";
        

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "id": "61afc0531573b08ddbe36e1c85602827",
            "href": "https://staging.getourvoice.com/api/v1/scopes/61afc0531573b08ddbe36e1c85602827",
            "name": "John",
            "description": "description",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
        }',
        ]);
       
        $this->client->scopes->create($scope);
    }
    public function testListScope(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'scopes', null, null);
        $this->client->scopes->read();
    }

    public function testViewScope(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'scopes/scope_id',
            null,
            null
        );
        $this->client->scopes->read("scope_id");
    }
    public function testDeleteScope(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'scopes/scope_id',
            null,
            null
        );
        $this->client->scopes->delete("scope_id");
    }
}
