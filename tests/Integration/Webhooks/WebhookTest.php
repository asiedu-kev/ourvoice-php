<?php

namespace Tests\Integration\Webhooks;

use  Ourvoice\Common\HttpClient;
use  Ourvoice\Exceptions\ServerException;
use  Ourvoice\Objects\BaseList;
use  Ourvoice\Objects\Contact;
use  Ourvoice\Objects\Account;
use Ourvoice\Objects\Plan;
use Ourvoice\Objects\Subscription;
use Ourvoice\Objects\Webhook;
use Tests\Integration\BaseTest;

class WebhookTest extends BaseTest
{
    public function testCreateWebhook(): void
    {
        $webhook = new Webhook();
        $webhook->url = 'hhtp://mywebhook.com';

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "url" : "hhtp://mywebhook.com",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
        }',
        ]);

        $this->client->webhooks->create($webhook);
    }

    public function testListWebhooks(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'webhooks',
            ['offset' => 100, 'limit' => 30],
            null
        );
        $this->client->webhooks->getList(['offset' => 100, 'limit' => 30]);
    }

    public function testViewWebhook(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'webhooks/webhook_id',
            null,
            null
        );
        $this->client->webhooks->read("webhook_id");
    }


    public function testDeleteWebhook(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'webhooks/webhook_id',
            null,
            null
        );
        $this->client->webhooks->delete("webhook_id");
    }




}
