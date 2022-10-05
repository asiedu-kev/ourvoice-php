<?php

namespace Ourvoice\Sdk\Common;

/**
 * Class Authentication
 *
 * @package Ourvoice\Sdk\Common
 */
class Authentication
{
    public $accessKey;

    /**
     * @param mixed $accessKey
     */
    public function __construct($accessKey)
    {
        $this->accessKey = $accessKey;
    }
}
