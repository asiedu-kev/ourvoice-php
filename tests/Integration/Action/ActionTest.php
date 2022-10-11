<?php

namespace Tests\Integration\Action;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use  Ourvoice\Sdk\Objects\Action;
use Tests\Integration\BaseTest;

class ActionTest extends BaseTest
{

    public function testCreateAction(): void
    {
       

        $action = new Action();
        $action->label = "John";
        $action->description = "Johnhg";
        

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "label": "John",
            "description": "Johnhg",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
        }',
        ]);
       
        $this->client->actions->create($action);
    }
    public function testListAction(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'actions', null, null);
        $this->client->actions->read();
    }

    public function testViewAction(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'actions/action_id',
            null,
            null
        );
        $this->client->actions->read("action_id");
    }

    public function testUpdateAction(): void
    {
        $action = new Action();
        $action->label = "John";
        $action->description = "Johnhg";

        $this->mockClient
            ->expects($this->once())
            ->method('performHttpRequest')
            ->with(
                'PUT',
                'actions/action_id',
                null,
                '{"label":"John","description":"Johnhg"}'
            )
            ->willReturn([
                204,
                '',
                '{"label":"John code"}'
            ]);

        $this->client->actions->update($action, 'action_id');
    }

    public function testDeleteAction(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'actions/action_id',
            null,
            null
        );
        $this->client->actions->delete("action_id");
    }
}
