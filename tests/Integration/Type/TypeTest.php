<?php

namespace Tests\Integration\Type;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use  Ourvoice\Sdk\Objects\Scope;
use  Ourvoice\Sdk\Objects\Type;
use Tests\Integration\BaseTest;

class TypeTest extends BaseTest
{

    /*public function testCreateType(): void
    {
        $scope = new Scope();
        $type = new Type();
        $type->name = "John";
        $type->scope_id = $scope->id;

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "id": "61afc0531573b08ddbe36e1c85602827",
            "href": "https://staging.getourvoice.com/api/v1/types/61afc0531573b08ddbe36e1c85602827",
            "name": "John",
            "scope_id": "$scope->id",
            
        }',
        ]);
        
        $this->client->types->create($type);
    }*/
    public function testCreateType(): void
    {
        $this->expectException(ServerException::class);
        $scope = new Scope();
        $type = new Type();
        $type->name = "Johns";
        $type->scope_id = $scope->id;

        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "POST",
            'types',
            null,
           // '{"name":"Johns","scope_id":"$scope->id"}',
        );
        $this->client->types->create($type);
    }
    public function testListType(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'types', null, null);
        $this->client->types->read();
    }

    public function testViewType(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'types/type_id',
            null,
            null
        );
        $this->client->types->read("type_id");
    }
    public function testDeleteType(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'types/type_id',
            null,
            null
        );
        $this->client->types->delete("type_id");
    }
}
