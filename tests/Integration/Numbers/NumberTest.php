<?php

namespace Tests\Integration\Numbers;

use  Ourvoice\Common\HttpClient;
use  Ourvoice\Exceptions\ServerException;
use  Ourvoice\Objects\BaseList;
use  Ourvoice\Objects\Contact;
use  Ourvoice\Objects\Account;
use Tests\Integration\BaseTest;

class NumberTest extends BaseTest
{
    public function testListNumbers(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'numbers',
            ['offset' => 100, 'limit' => 30],
            null
        );
        $this->client->numbers->getList(['offset' => 100, 'limit' => 30]);
    }

    public function testViewNumber(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'numbers/number_id',
            null,
            null
        );
        $this->client->numbers->read("number_id");
    }
}
