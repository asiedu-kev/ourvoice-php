<?php

namespace Tests\Integration\Account;

use Ourvoice\Sdk\Exceptions\ServerException;
use Tests\Integration\BaseTest;
use  Ourvoice\Sdk\Objects\User;
use  Ourvoice\Sdk\Objects\Account;

class AccountTest extends BaseTest
{
    public function testCreateAccount(): void
    {
        $user = new User();
        $user->id = "61afc0531573b08ddbe36e1c85602827";
        $account = new Account();
        $account->organization_name = "John";
        $account->status = "active";
        $account->type = "test";
        $account->user_id = $user->id;

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "organization_name": "John",
            "status":"active",
            "type":"test",
            "user_id": "$user->id",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
            
        }',
        ]);
        
        $this->client->accounts->create($account);
    }

    public function testListAccount(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'accounts', null, null);
        $this->client->accounts->read();
    }

    public function testViewAccount(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'accounts/account_id',
            null,
            null
        );
        $this->client->accounts->read("account_id");
    }
    public function testDeleteAccount(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'accounts/account_id',
            null,
            null
        );
        $this->client->accounts->delete("account_id");
    }
}
