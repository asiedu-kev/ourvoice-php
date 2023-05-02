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

    public const REQUEST_NOT_AUTHENTICATED = 401;


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
