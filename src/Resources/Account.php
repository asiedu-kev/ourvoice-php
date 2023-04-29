<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Account extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Account();
        $this->setResourceName('accounts');

        parent::__construct($httpClient);
    }
}
