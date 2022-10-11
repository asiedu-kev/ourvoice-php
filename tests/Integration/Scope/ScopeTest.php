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

    public function testUpdateScope(): void
    {
        $scope = new Scope();
        $scope->name = "John";
        $scope->description = "description";

        $this->mockClient
            ->expects($this->once())
            ->method('performHttpRequest')
            ->with(
                'PUT',
                'scopes/scope_id',
                null,
                '{"name":"John","description":"description"}'
            )
            ->willReturn([
                204,
                '',
                '{"name":"John code"}'
            ]);

        $this->client->scopes->update($scope, 'scope_id');
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
