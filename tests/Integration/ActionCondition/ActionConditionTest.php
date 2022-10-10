<?php

namespace Tests\Integration\ActionCondition;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use  Ourvoice\Sdk\Objects\Action;
use  Ourvoice\Sdk\Objects\ActionCondition;
use  Ourvoice\Sdk\Objects\Condition;
use Tests\Integration\BaseTest;

class ActionConditionTest extends BaseTest
{


   /* public function testCreateActionCondition(): void
    {
        $this->expectException(ServerException::class);
        $action_conditions = new ActionCondition();
        $condition = new Condition();
        $action = new Action();
        $action_condition->min_value = "1";
        $action_condition->max_value = "9";
        $action_condition->categorised_value = "5";
        $action_condition->text_value = "Johnhg";
        $action_condition->condition_id = $condition->id;
        $action_condition->action_id =  $action->id;

        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "POST",
            'action-conditions',
            null,
            '{"min_value":"1","max_value":"9","categorised_value":"5","text_value":"Johnhg","condition_id":"$condition->id","action_id":"$action->id"}'
        );
        $this->client->action_conditions->create($action_condition);
    } */

    public function testListActionCondition(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'action-conditions', null, null);
        $this->client->action_conditions->read();
    }

    public function testViewActionCondition(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'action-conditions/action_condition_id',
            null,
            null
        );
        $this->client->action_conditions->read("action_condition_id");
    }
    public function testDeleteActionCondition(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'action-conditions/action_condition_id',
            null,
            null
        );
        $this->client->action_conditions->delete("action_condition_id");
    }
}
