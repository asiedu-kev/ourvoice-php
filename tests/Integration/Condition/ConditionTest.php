<?php

namespace Tests\Integration\Condition;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use  Ourvoice\Sdk\Objects\Condition;
use Tests\Integration\BaseTest;

class ConditionTest extends BaseTest
{

    /* public function testCreateCondition(): void
    {
       

        $condition = new Condition();
        $condition->label = "John";
        $condition->description = "Johnhg";
        

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "href": "https://staging.getourvoice.com/api/v1/conditions/61afc0531573b08ddbe36e1c85602827",
            "label": "John",
            "description": "Johnhg",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
        }',
        ]);
       
        $this->client->conditions->create($condition);
    }*/
    public function testCreateCondition(): void
    {
        $this->expectException(ServerException::class);
        $condition = new Condition();
        $condition->label = "John";
        $condition->description = "Johnhg";

        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "POST",
            'conditions',
            null,
            '{"label":"John","description":"Johnhg"}'
        );
        $this->client->conditions->create($condition);
    }
    public function testListCondition(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'conditions', null, null);
        $this->client->conditions->read();
    }

    public function testViewCondition(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'conditions/condition_id',
            null,
            null
        );
        $this->client->conditions->read("condition_id");
    }
    public function testDeleteCondition(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'conditions/condition_id',
            null,
            null
        );
        $this->client->conditions->delete("condition_id");
    }
}
