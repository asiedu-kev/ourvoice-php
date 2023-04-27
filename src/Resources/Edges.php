<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Edges extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Edge();
        $this->setResourceName('edges');

        parent::__construct($httpClient);
    }
}
