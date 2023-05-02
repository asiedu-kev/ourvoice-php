<?php

namespace Tests\Integration\Subscriptions;

use  Ourvoice\Common\HttpClient;
use  Ourvoice\Exceptions\ServerException;
use  Ourvoice\Objects\BaseList;
use  Ourvoice\Objects\Contact;
use  Ourvoice\Objects\Account;
use Ourvoice\Objects\Plan;
use Ourvoice\Objects\Subscription;
use Tests\Integration\BaseTest;

class SubscriptionTest extends BaseTest
{
    public function testCreateSubscription(): void
    {
        $account = new Account();
        $plan = new Plan();
        $subscription = new Subscription();
        $subscription->account_id = $account->id;
        $subscription->plan_id = $plan->id;

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "status" : "is_active",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
        }',
        ]);

        $this->client->subscriptions->create($subscription);
    }

    public function testListSubscriptions(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'subscriptions',
            ['offset' => 100, 'limit' => 30],
            null
        );
        $this->client->subscriptions->getList(['offset' => 100, 'limit' => 30]);
    }

    public function testViewSubscription(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'subscriptions/subscription_id',
            null,
            null
        );
        $this->client->subscriptions->read("subscription_id");
    }


    public function testDeleteSubscription(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'subscriptions/subscription_id',
            null,
            null
        );
        $this->client->subscriptions->delete("subscription_id");
    }




}
