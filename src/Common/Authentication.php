<?php

namespace Ourvoice\Common;

/**
 * Class Authentication
 *
 * @package Ourvoice\Sdk\Common
 */
class Authentication
{
    public $accessToken;

    /**
     * @param mixed $accessToken
     */
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }
}
