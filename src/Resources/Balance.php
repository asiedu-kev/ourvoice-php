<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Balance
 *
 * @package Ourvoice\Sdk\Resources
 */
class Balance extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Balance();
        $this->setResourceName('balances');

        parent::__construct($httpClient);
    }
}
