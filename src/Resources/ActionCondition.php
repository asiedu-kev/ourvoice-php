<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class ActionCondition
 *
 * @package Ourvoice\Sdk\Resources
 */
class ActionCondition extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\ActionCondition();
        $this->setResourceName('action-conditions');

        parent::__construct($httpClient);
    }
}
