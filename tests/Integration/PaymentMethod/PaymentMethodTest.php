<?php

namespace Tests\Integration\PaymentMethod;

use Ourvoice\Sdk\Exceptions\ServerException;
use  Ourvoice\Sdk\Common\HttpClient;
use Tests\Integration\BaseTest;

class PaymentMethodTest extends BaseTest
{
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
