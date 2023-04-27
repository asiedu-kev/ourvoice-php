<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Numbers extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Number();
        $this->setResourceName('numbers');

        parent::__construct($httpClient);
    }
}
