<?php

namespace Ourvoice\Objects;

use stdClass;

/**
 * Class Flow
 *
 * @package Ourvoice\Sdk\Objects
 */
class Flow extends Base
{

    public $id;

    public $name;

    public $account_id;

    public $description;

    public $type;

    protected $status;

    protected $metadata;

    protected $recording;

    protected $createdDatetime;

    protected $updatedDatetime;

    public function getId(): string
    {
        return $this->id;
    }
}
