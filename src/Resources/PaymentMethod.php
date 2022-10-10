<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class PaymentMethod
 *
 * @package Ourvoice\Sdk\Resources
 */
class PaymentMethod extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\PaymentMethod();
        $this->setResourceName('payment-methods');

        parent::__construct($httpClient);
    }
}
