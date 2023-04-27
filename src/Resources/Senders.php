<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class Senders extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Sender();
        $this->setResourceName('senders');

        parent::__construct($httpClient);
    }
}
