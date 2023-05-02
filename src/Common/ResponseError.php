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

    public const SUCCESS = 200;

    public const NO_CONTENT = 204;

    public const REQUEST_NOT_AUTHENTICATED = 401;

    public const MISSING_OR_INVALID_PARAMS = 422;

    public const NOT_FOUND = 404;

    public const NOT_ALLOWED = 403;

    public const SERVICE_UNAVAILABLE = 405;

    public const ERROR_SERVER = 500;

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
