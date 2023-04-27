<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Subscriptions extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Subscription();
        $this->setResourceName('subscriptions');

        parent::__construct($httpClient);
    }
}
