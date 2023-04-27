<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Resources
 */
class FlowExecutions extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\FlowExecution();
        $this->setResourceName('flow-executions');

        parent::__construct($httpClient);
    }
}
