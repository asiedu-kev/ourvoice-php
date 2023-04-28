<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Webhooks extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Webhook();
        $this->setResourceName('webhooks');

        parent::__construct($httpClient);
    }
}
