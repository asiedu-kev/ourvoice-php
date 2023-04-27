<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Voices extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Voice();
        $this->setResourceName('voices');

        parent::__construct($httpClient);
    }
}
