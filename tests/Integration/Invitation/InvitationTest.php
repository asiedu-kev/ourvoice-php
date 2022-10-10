<?php

namespace Tests\Integration\Invitation;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use Tests\Integration\BaseTest;

class InvitationTest extends BaseTest
{
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
