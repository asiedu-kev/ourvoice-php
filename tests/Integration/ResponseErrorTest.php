<?php

namespace Tests\Integration;

use Ourvoice\Common\ResponseError;
use Ourvoice\Exceptions\OurvoiceException;

class ResponseErrorTest extends BaseTest
{
    public const EXCEPTION_MESSAGE = 'Got error response from the server: %s';

    public const SINGLE_ERROR_JSON = '["Unauthenticated"]';

    public function testSingleError(): void
    {
        self::assertEquals(
            sprintf(self::EXCEPTION_MESSAGE, 'Unauthenticated'),
            $this->getExceptionMessageFromJson('401',self::SINGLE_ERROR_JSON)
        );
    }

    private function getExceptionMessageFromJson($code,$json): string
    {
        try {
            new ResponseError('401',json_decode($json,null, 512, \JSON_THROW_ON_ERROR));
        } catch (OurvoiceException | \JsonException $e) {
        
            return $e->getMessage();
        }

        self::fail('No exception thrown');
    }
}
