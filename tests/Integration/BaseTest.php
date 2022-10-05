<?php

namespace Tests\Integration;

use Ourvoice\Sdk\Client;
use Ourvoice\Sdk\Common\HttpClient;
use Ourvoice\Sdk\Resources\Balance;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    /** @var Client */
    protected $client;

    /** @var MockObject */
    protected $mockClient;

    public function testClientConstructor(): void
    {
        $ourvoiceSdk = new Client('YOUR_ACCESS_KEY');
        self::assertInstanceOf(Balance::class, $ourvoiceSdk->balance);
        
    }

    public function testHttpClientMock(): void
    {
        $this->mockClient->expects($this->atLeastOnce())->method('addUserAgentString');
        new Client('YOUR_ACCESS_KEY', $this->mockClient);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockClient = $this->getMockBuilder(HttpClient::class)->setConstructorArgs(["fake.messagebird.dev"])->getMock();
        $this->client = new Client('YOUR_ACCESS_KEY', $this->mockClient);
    }

    /**
     * Prevents a test that performs no assertions from being considered risky.
     * The doesNotPerformAssertions annotation is not available in earlier PHPUnit
     * versions, and hence can not be used.
     */
    protected function doAssertionToNotBeConsideredRiskyTest(): void
    {
        static::assertTrue(true);
    }
}
