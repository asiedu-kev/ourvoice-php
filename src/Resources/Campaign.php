<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Campaign
 *
 * @package Ourvoice\Sdk\Resources
 */
class Campaign extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Campaign();
        $this->setResourceName('campaigns');

        parent::__construct($httpClient);
    }
}
