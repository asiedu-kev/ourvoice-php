<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class NumberRequests extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\NumberRequest();
        $this->setResourceName('number-requests');

        parent::__construct($httpClient);
    }
}
