<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Objects;

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
