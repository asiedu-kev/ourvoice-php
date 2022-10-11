<?php

namespace Tests\Integration\PaymentMethod;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use Tests\Integration\BaseTest;
use  Ourvoice\Sdk\Objects\Account;
use  Ourvoice\Sdk\Objects\PaymentMethod;

class PaymentMethodTest extends BaseTest
{

    public function testCreatePaymentMethod(): void
    {
        $account = new Account();
        $account->id = "61afc0531573b08ddbe36e1c85602827";
        $paymentmethod = new PaymentMethod();
        $paymentmethod->type = "sms";
        //$paymentmethod->card_brand = "22961616823";
        //$paymentmethod->last4 = "never";
        //$paymentmethod->exp_month = "test app";
        //$paymentmethod->exp_year = "seding";
        $paymentmethod->phone_number = "22961616823";
        $paymentmethod->account_id = $account->id;
    

        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{
            "type": "sms",
            "phone_number":"22961616823",
            "account_id": "$account->id",
            "group_id": "$group->id",
            "message_id": "$message->id",
            "createdDatetime": "2016-04-29T09:42:26+00:00",
            "updatedDatetime": "2016-04-29T09:42:26+00:00"
            
        }',
        ]);
        $this->client->payment_methods->create($paymentmethod);
    }

    public function testListPaymentMethod(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with("GET", 'payment-methods', null, null);
        $this->client->payment_methods->read();
    }

    public function testViewPaymentMethod(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "GET",
            'payment-methods/payment_method_id',
            null,
            null
        );
        $this->client->payment_methods->read("payment_method_id");
    }

    public function testUpdatePaymentMethod(): void
    {
        $this->mockClient
            ->expects($this->exactly(1))->method('performHttpRequest')
            ->withConsecutive(
                ['PUT', 'payment-methods/payment_method_id', null, '{"type":"archived"}'],
               
            )
            ->willReturn([200, '', '{}']);

        $paymentmethod = new PaymentMethod();
        $paymentmethod->type = "archived" ;
        $this->client->payment_methods->update($paymentmethod, 'payment_method_id');

    }

    public function testDeletePaymentMethod(): void
    {
        $this->expectException(ServerException::class);
        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            "DELETE",
            'payment-methods/payment_method_id',
            null,
            null
        );
        $this->client->payment_methods->delete("payment_method_id");
    }
}
