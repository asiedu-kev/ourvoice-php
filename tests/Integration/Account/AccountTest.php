<?php

namespace Tests\Integration\Account;

use Ourvoice\Sdk\Exceptions\ServerException;
use Tests\Integration\BaseTest;

class AccountTest extends BaseTest
{
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
