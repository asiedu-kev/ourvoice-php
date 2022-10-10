<?php

namespace Tests\Integration\Media;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use Tests\Integration\BaseTest;

class MediaTest extends BaseTest
{
    public function testListMedia(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'medias', null, null);
        $this->client->medias->read();
    }

    public function testViewMedia(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'medias/media_id',
            null,
            null
        );
        $this->client->medias->read("media_id");
    }
    public function testDeleteMedia(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'medias/media_id',
            null,
            null
        );
        $this->client->medias->delete("media_id");
    }
}
