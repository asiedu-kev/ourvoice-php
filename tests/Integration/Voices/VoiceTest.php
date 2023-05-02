<?php

namespace Tests\Integration\Voices;

use  Ourvoice\Exceptions\ServerException;
use Ourvoice\Objects\Voice;
use Tests\Integration\BaseTest;

class VoiceTest extends BaseTest
{
//    public function testCreateVoice(): void
//    {
//        $voice = new Voice();
//        $voice->audio_url = "https://ourvoice-bucket.s3.eu-west-3.amazonaws.com/medias
//        /mp3/1674343068-Alphabe%CC%81Nume%CC%81Dendi.mp3";
//        $voice->to = "22962471176";
//
//        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
//            200,
//            '',
//            '{
//            "audio_url" : "https://www.audiomp3.file.com",
//            "direction" " "outgoing",
//            "createdDatetime": "2016-04-29T09:42:26+00:00",
//            "updatedDatetime": "2016-04-29T09:42:26+00:00"
//        }',
//        ]);
//
//        $this->client->voices->create($voice);
//    }

    public function testListVoices(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'voices',
            ['offset' => 100, 'limit' => 30],
            null
        );
        $this->client->voices->getList(['offset' => 100, 'limit' => 30]);
    }

    public function testViewVoice(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'voices/voice_id',
            null,
            null
        );
        $this->client->voices->read("voice_id");
    }


    public function testDeleteVoice(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'voices/voice_id',
            null,
            null
        );
        $this->client->voices->delete("voice_id");
    }
}
