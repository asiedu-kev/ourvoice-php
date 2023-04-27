<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Transactions extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Transaction();
        $this->setResourceName('transactions');

        parent::__construct($httpClient);
    }
}
