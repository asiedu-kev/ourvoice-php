<?php

namespace Tests\Integration;

use Ourvoice\Sdk\Common\ResponseError;
use Ourvoice\Sdk\Exceptions\OurvoiceException;

class ResponseErrorTest extends BaseTest
{
    public const EXCEPTION_MESSAGE = 'Got error response from the server: %s';

    public const SINGLE_ERROR_JSON = '{"errors":[{"code":25,"description":"foo"}]}';
    public const MULTIPLE_ERRORS_JSON = '{"errors":[{"code":9,"description":"foo"},{"code":25,"description":"bar"}]}';

    public function testSingleError(): void
    {
        self::assertEquals(
            sprintf(self::EXCEPTION_MESSAGE, 'foo'),
            $this->getExceptionMessageFromJson(self::SINGLE_ERROR_JSON)
        );
    }

    private function getExceptionMessageFromJson($json): string
    {
        try {
            new ResponseError(json_decode($json,null, 512, \JSON_THROW_ON_ERROR));
        } catch (OurvoiceException | \JsonException $e) {
        
            return $e->getMessage();
        }

        self::fail('No exception thrown');
    }

    public function testMultipleErrors(): void
    {
        self::assertEquals(
            sprintf(self::EXCEPTION_MESSAGE, 'bar'),
            $this->getExceptionMessageFromJson(self::MULTIPLE_ERRORS_JSON)
        );
    }
}
