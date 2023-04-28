<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Plans extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Plan();
        $this->setResourceName('plans');

        parent::__construct($httpClient);
    }
}
