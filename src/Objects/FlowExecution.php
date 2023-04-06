<?php

namespace Ourvoice\Sdk\Objects;

use stdClass;

/**
 * Class FlowExecution
 *
 * @package Ourvoice\Sdk\Objects
 */
class FlowExecution extends Base
{
    public $id;

    public $flow_id;

    public $caller;

    public $callee;

    public $start_time;

    protected $end_time;

    protected $status;

    protected $recording;

    protected $createdDatetime;

    protected $updatedDatetime;

    public function getId(): string
    {
        return $this->id;
    }
}
