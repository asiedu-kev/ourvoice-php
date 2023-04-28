<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Objects;

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
