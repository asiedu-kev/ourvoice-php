<?php

namespace Tests\Integration\User;

use Ourvoice\Sdk\Exceptions\ServerException;
use Tests\Integration\BaseTest;
use  Ourvoice\Sdk\Objects\User;
class UserTest extends BaseTest
{
    public function testCreateUser(): void
    {
        $user = new User();
        
        $user->first_name = "John";
        $user->last_name = "Johnhg";
        $user->phone = "+65962333";
        $user->email = "admin@gmail.com";
       

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "first_name": "John",
            "last_name":"Johnhg",
            "phone":"+65962333",
            "email": "admin@gmail.com",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
            
        }',
        ]);
        
        $this->client->users->create($user);
    }

    public function testListUser(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'users', null, null);
        $this->client->users->read();
    }

    public function testViewUser(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'users/user_id',
            null,
            null
        );
        $this->client->users->read("user_id");
    }

    public function testUpdateUser(): void
    {
        $user = new User();
        $user->first_name = "John";
        $user->last_name = "Johnhg";
        $user->phone = "+65962333";
        $user->email = "admin@gmail.com";

        $this->mockClient
            ->expects($this->once())
            ->method('performHttpRequest')
            ->with(
                'PUT',
                'users/user_id',
                null,
                '{"first_name":"John","last_name":"Johnhg","phone":"+65962333","email":"admin@gmail.com"}'
            )
            ->willReturn([
                204,
                '',
                '{"first_name":"John code"}'
            ]);

        $this->client->users->update($user, 'user_id');
    }

    public function testDeleteUser(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'users/user_id',
            null,
            null
        );
        $this->client->users->delete("user_id");
    }
}
