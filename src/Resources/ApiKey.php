<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class ApiKey
 *
 * @package Ourvoice\Sdk\Resources
 */
class ApiKey extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\ApiKey();
        $this->setResourceName('api-keys');

        parent::__construct($httpClient);
    }
}
