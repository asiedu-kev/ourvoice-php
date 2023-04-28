<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Objects;

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
