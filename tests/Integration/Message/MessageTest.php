<?php

namespace Tests\Integration\Message;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use Tests\Integration\BaseTest;

class MessageTest extends BaseTest
{
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
