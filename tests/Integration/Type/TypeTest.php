<?php

namespace Tests\Integration\Type;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use  Ourvoice\Sdk\Objects\Scope;
use  Ourvoice\Sdk\Objects\Type;
use Tests\Integration\BaseTest;

class TypeTest extends BaseTest
{

    public function testCreateType(): void
    {
        $scope = new Scope();
        $scope->id = "61afc0531573b08ddbe36e1c85602827";
        $type = new Type();
        $type->name = "John";
        $type->description = "Johnhg";
        $type->scope_id = $scope->id;

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "name": "John",
            "description":"Johnhg",
            "scope_id": "$scope->id",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
            
        }',
        ]);
        
        $this->client->types->create($type);
    }
   /*public function testCreateType(): void
    {
        $this->expectException(ServerException::class);
        $scope = new Scope();
        $scope->id = "61afc0531573b08ddbe36e1c85602827";
        $type = new Type();
        $type->name = "Johns";
        $type->description = "Johnhg";
        $type->scope_id = $scope->id;

        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "POST",
            'types',
            null,
           '{"name":"Johns","description":"Johnhg","scope_id":"$scope->id"}',
        );
        $this->client->types->create($type);
    }*/
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

    public function testUpdateType(): void
    {
        $this->mockClient
            ->expects($this->exactly(1))->method('performHttpRequest')
            ->withConsecutive(
                ['PUT', 'types/type_id', null, '{"name":"archived"}'],
               
            )
            ->willReturn([200, '', '{}']);

        $type = new Type();
        $type->name = "archived" ;
        $this->client->types->update($type, 'type_id');

    }
    
}
