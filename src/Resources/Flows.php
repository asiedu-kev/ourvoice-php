<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Flows extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Flow();
        $this->setResourceName('flows');

        parent::__construct($httpClient);
    }
}
