<?php

namespace Tests\Integration\Steps;

use  Ourvoice\Common\HttpClient;
use  Ourvoice\Exceptions\ServerException;
use  Ourvoice\Objects\BaseList;
use  Ourvoice\Objects\Contact;
use  Ourvoice\Objects\Account;
use Tests\Integration\BaseTest;

class StepTest extends BaseTest
{
    public function testListSteps(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'steps',
            ['offset' => 100, 'limit' => 30],
            null
        );
        $this->client->steps->getList(['offset' => 100, 'limit' => 30]);
    }

    public function testViewStep(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'steps/step_id',
            null,
            null
        );
        $this->client->steps->read("step_id");
    }
}
