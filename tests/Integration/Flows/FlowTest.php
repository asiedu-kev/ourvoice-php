<?php

namespace Tests\Integration\Flows;

use  Ourvoice\Common\HttpClient;
use  Ourvoice\Exceptions\ServerException;
use  Ourvoice\Objects\BaseList;
use  Ourvoice\Objects\Contact;
use  Ourvoice\Objects\Account;
use Tests\Integration\BaseTest;

class FlowTest extends BaseTest
{
    public function testListFlows(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'flows',
            ['offset' => 100, 'limit' => 30],
            null
        );
        $this->client->flows->getList(['offset' => 100, 'limit' => 30]);
    }

    public function testViewFlow(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'flows/flow_id',
            null,
            null
        );
        $this->client->flows->read("flow_id");
    }
}
