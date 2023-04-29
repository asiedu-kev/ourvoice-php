<?php

namespace Ourvoice\Common;

use Ourvoice\Exceptions;

/**
 * Class ResponseError
 *
 * @package Ourvoice\Common
 */
class ResponseError
{
    public const EXCEPTION_MESSAGE = 'Got error response from the server: %s';

    public const SUCCESS = 1;

    public const REQUEST_NOT_AUTHENTICATED = 401;

    public const MISSING_PARAMS = 9;
    public const INVALID_PARAMS = 10;

    public const NOT_FOUND = 20;

    public const NOT_ENOUGH_CREDIT = 25;

    public $errors = [];

    public function __construct($code,$body)
    {
            foreach ($body as $error) {
                if ((int)$code === self::REQUEST_NOT_AUTHENTICATED ) {
                    throw new Exceptions\AuthenticateException($this->getExceptionMessage($error));
                }
                $this->errors[] = $error;
            }
    }

    private function getExceptionMessage($error)
    {
        return sprintf(self::EXCEPTION_MESSAGE, $error);
    }


    public function getErrorString()
    {
        return implode(', ', $this->errors);
    }
}
