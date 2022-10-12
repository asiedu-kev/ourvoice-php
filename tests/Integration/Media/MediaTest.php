<?php

namespace Tests\Integration\Media;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use Tests\Integration\BaseTest;
use  Ourvoice\Sdk\Objects\Account;
use  Ourvoice\Sdk\Objects\Media;

class MediaTest extends BaseTest
{

    public function testCreateMedia(): void
    {
       
        $account = new Account();
        $media = new Media();
        $media->name = "John";
        $media->media_url = "https://stackoverflow.com/";
        $media->type = "voice";
        $media->account_id = $account->id;
        

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "name": "John",
            "media_url": "https://stackoverflow.com/",
            "type": "voice",
            "account_id": "$account->id",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
        }',
        ]);
       
        $this->client->medias->create($media);
    }


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

    public function testUpdateMedia(): void
    {
        $this->mockClient
            ->expects($this->exactly(1))->method('performHttpRequest')
            ->withConsecutive(
                ['PUT', 'medias/media_id', null, '{"name":"archived"}'],
               
            )
            ->willReturn([200, '', '{}']);

        $media = new Media();
        $media->name = "archived" ;
        $this->client->medias->update($media, 'media_id');

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
