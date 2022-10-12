<?php

namespace Tests\Integration\Invitation;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use  Ourvoice\Sdk\Objects\Account;
use  Ourvoice\Sdk\Objects\Role;
use  Ourvoice\Sdk\Objects\Invitation;
use Tests\Integration\BaseTest;

class InvitationTest extends BaseTest
{

    public function testCreateInvitation(): void
    {
       
        $account = new Account();
        $role = new Role();
        $role->id = "67afc0531573b08ddbe36e1c85602827";
        $invitation = new Invitation();
        $invitation->email = "admin@gmail.com";
        $invitation->role_id = $role->id;
        $invitation->account_id = $account->id;
        

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "email": "admin@gmail.com",
            "role_id": "$role->id",
            "account_id": "$account->id",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
        }',
        ]);
       
        $this->client->invitations->create($invitation);
    }

    public function testListInvitation(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'invitations', null, null);
        $this->client->invitations->read();
    }

    public function testViewInvitation(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'invitations/invitation_id',
            null,
            null
        );
        $this->client->invitations->read("invitation_id");
    }

    public function testUpdateInvitation(): void
    {
        $this->mockClient
            ->expects($this->exactly(1))->method('performHttpRequest')
            ->withConsecutive(
                ['PUT', 'invitations/invitation_id', null, '{"email":"gagle@gmail.com"}'],
               
            )
            ->willReturn([200, '', '{}']);

        $invitation = new Invitation();
        $invitation->email = "gagle@gmail.com" ;
        $this->client->invitations->update($invitation, 'invitation_id');

    }

    public function testDeleteInvitation(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'invitations/invitation_id',
            null,
            null
        );
        $this->client->invitations->delete("invitation_id");
    }
}
