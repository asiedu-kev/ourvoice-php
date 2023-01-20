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
        $account = new Account();
        $account->name = $user->first_name .' '. $user->last_name.' Account';
        $account->status = "active";
        $account->owner_id = $user->id;

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "status":"active",
            "type":"test",
            "owner_id": "$user->id",
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

    public function testUpdateAccount(): void
    {
        $this->mockClient
            ->expects($this->exactly(1))->method('performHttpRequest')
            ->withConsecutive(
                ['PUT', 'accounts/account_id', null, '{"status":"sending"}'],
               
            )
            ->willReturn([200, '', '{}']);

        $account = new Account();
        $account->status = "sending" ;
        $this->client->accounts->update($account, 'account_id');

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
