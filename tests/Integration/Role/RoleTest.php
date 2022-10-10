<?php

namespace Tests\Integration\Role;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use  Ourvoice\Sdk\Objects\Role;
use Tests\Integration\BaseTest;

class RoleTest extends BaseTest
{

    public function testCreateRole(): void
    {
       

        $role = new Role();
        $role->name = "John";
        $role->description = "Johnhg";
        

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "id": "61afc0531573b08ddbe36e1c85602827",
            "href": "https://staging.getourvoice.com/api/v1/roles/61afc0531573b08ddbe36e1c85602827",
            "name": "John",
            "description": "Johnhg",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
        }',
        ]);
       
        $this->client->roles->create($role);
    }
    public function testListRole(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'roles', null, null);
        $this->client->roles->read();
    }

    public function testViewRole(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'roles/role_id',
            null,
            null
        );
        $this->client->roles->read("role_id");
    }
    public function testDeleteRole(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'roles/role_id',
            null,
            null
        );
        $this->client->roles->delete("role_id");
    }
}
