<?php

namespace Ourvoice\Sdk\Objects;

/**
 * Class Campaign
 *
 * @package Ourvoice\Sdk\Objects
 */
class Campaign extends Base
{
   
    public $account_id;

    public $name;

    public $group_id;

    public $type;

    public $repeat;

    public $start_date;

    public $end_date;

    public $status;

    protected $id;
}
