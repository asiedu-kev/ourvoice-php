<?php

namespace Tests\Integration\Balance;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use Tests\Integration\BaseTest;
use  Ourvoice\Sdk\Objects\Balance;
use  Ourvoice\Sdk\Objects\Account;

class BalanceTest extends BaseTest
{

    public function testCreateBalance(): void
    {
        $account = new Account();
        $balance = new Balance();
        $balance->currency = "5";
        $balance->amount = "8";
        $balance->available_credit = "5000";
        $balance->account_id = $account->id;

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "currency": "5",
            "amount":"8",
            "available_credit":"5000",
            "account_id": "$account->id",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
            
        }',
        ]);
        
        $this->client->balances->create($balance);
    }
    public function testListBalance(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'balances', null, null);
        $this->client->balances->read();
    }

    public function testViewBalance(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'balances/balance_id',
            null,
            null
        );
        $this->client->balances->read("balance_id");
    }

    public function testUpdateBalance(): void
    {
        $this->mockClient
            ->expects($this->exactly(1))->method('performHttpRequest')
            ->withConsecutive(
                ['PUT', 'balances/balance_id', null, '{"currency":"4"}'],
               
            )
            ->willReturn([200, '', '{}']);

        $balance = new Balance();
        $balance->currency = "4" ;
        $this->client->balances->update($balance, 'balance_id');

    }

    public function testDeleteBalance(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'balances/balance_id',
            null,
            null
        );
        $this->client->balances->delete("balance_id");
    }
}
