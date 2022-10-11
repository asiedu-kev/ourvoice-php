<?php

namespace Ourvoice\Sdk\Common;

use Ourvoice\Sdk\Exceptions;

/**
 * Class ResponseError
 *
 * @package Ourvoice\Sdk\Common
 */
class ResponseError
{
    public const EXCEPTION_MESSAGE = 'Got error response from the server: %s';

    public const SUCCESS = 1;

    public const REQUEST_NOT_ALLOWED = 2;

    public const MISSING_PARAMS = 9;
    public const INVALID_PARAMS = 10;

    public const NOT_FOUND = 20;

    public const NOT_ENOUGH_CREDIT = 25;

    public $errors = [];

    public function __construct($body)
    {
        if (!empty($body->errors)) {
            foreach ($body->errors as $error) {
                if (!empty($error->message)) {
                    $error->description = $error->message;
                    unset($error->message);
                }

                if ($error->code === self::NOT_ENOUGH_CREDIT) {
                    throw new Exceptions\BalanceException($this->getExceptionMessage($error));
                } elseif ($error->code === self::REQUEST_NOT_ALLOWED) {
                    throw new Exceptions\AuthenticateException($this->getExceptionMessage($error));
                }

                $this->errors[] = $error;
            }
        }
    }

    private function getExceptionMessage($error)
    {
        return sprintf(self::EXCEPTION_MESSAGE, $error->description);
    }


    public function getErrorString()
    {
        $errorDescriptions = [];

        foreach ($this->errors as $error) {
            $errorDescriptions[] = $error->description;
        }

        return implode(', ', $errorDescriptions);
    }
}
