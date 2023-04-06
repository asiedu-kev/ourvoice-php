<?php

namespace Ourvoice\Sdk\Objects;

use stdClass;

/**
 * Class Edge
 *
 * @package Ourvoice\Sdk\Objects
 */
class Edge extends Base
{

    public $from_step_id;

    public $to_step_id;

    public $data;

    public $source_handle;

    protected $id;


    protected $createdDatetime;

    protected $updatedDatetime;

    public function getId(): string
    {
        return $this->id;
    }
}
