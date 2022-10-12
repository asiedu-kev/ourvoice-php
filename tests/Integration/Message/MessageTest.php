<?php

namespace Tests\Integration\Message;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use Tests\Integration\BaseTest;
use  Ourvoice\Sdk\Objects\Account;
use  Ourvoice\Sdk\Objects\Message;


class MessageTest extends BaseTest
{

    public function testCreateMessage(): void
    {
        $account = new Account();
        $message = new Message();
        $message->from = "22961616262";
        $message->direction = "never";
        $message->body = "test app";
        $message->to = "22961616823";
        $message->status = "seding";
        $message->cost = 0.03;
        $message->account_id = $account->id;
    

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "from": "22961616262",
            "direction":"never",
            "body":"test app",
            "to": "22961616823",
            "status":"seding",
            "cost": 0.03,
            "account_id": "$account->id",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
            
        }',
        ]);
        $this->client->messages->create($message);
    }
    public function testListMessage(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'messages', null, null);
        $this->client->messages->read();
    }

    public function testViewMessage(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'messages/message_id',
            null,
            null
        );
        $this->client->messages->read("message_id");
    }
    public function testUpdateMessage(): void
    {
        $this->mockClient
            ->expects($this->exactly(1))->method('performHttpRequest')
            ->withConsecutive(
                ['PUT', 'messages/message_id', null, '{"direction":"archived"}'],
               
            )
            ->willReturn([200, '', '{}']);

        $message = new Message();
        $message->direction = "archived" ;
        $this->client->messages->update($message, 'message_id');

    }

    public function testDeleteMessage(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'messages/message_id',
            null,
            null
        );
        $this->client->messages->delete("message_id");
    }
}
