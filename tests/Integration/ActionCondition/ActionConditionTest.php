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


    public function testCreateActionCondition(): void
    {
        $action = new Action();
        $condition = new Condition();
        $action_condition = new ActionCondition();
        $action_condition->min_value = "0";
        $action_condition->max_value = "9";
        $action_condition->categorised_value = "5";
        $action_condition->text_value = "Johnhg";
        $action_condition->condition_id = $condition->id;
        $action_condition->action_id =  $action->id;

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "min_value": "1",
            "max_value":"9",
            "categorised_value":"5",
            "text_value": "Johnhg",
            "condition_id": "$condition->id",
            "action_id": "$action->id",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
            
        }',
        ]);
        
        $this->client->action_conditions->create($action_condition);
    }

    public function testListAccount(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'accounts', null, null);
        $this->client->accounts->read();
    }


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
    public function testUpdateActionCondition(): void
    {
        $this->mockClient
            ->expects($this->exactly(1))->method('performHttpRequest')
            ->withConsecutive(
                ['PUT', 'action-conditions/action_condition_id', null, '{"min_value":"2"}'],
               
            )
            ->willReturn([200, '', '{}']);

        $action_condition = new ActionCondition();
        $action_condition->min_value = "2" ;
        $this->client->action_conditions->update($action_condition, 'action_condition_id');

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
