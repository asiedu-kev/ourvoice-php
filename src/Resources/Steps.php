<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Steps extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Step();
        $this->setResourceName('steps');

        parent::__construct($httpClient);
    }
}
