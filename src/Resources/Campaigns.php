<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Objects;

/**
 * Class Campaign
 *
 * @package Ourvoice\Sdk\Resources
 */
class Campaigns extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Campaign();
        $this->setResourceName('campaigns');

        parent::__construct($httpClient);
    }
}
