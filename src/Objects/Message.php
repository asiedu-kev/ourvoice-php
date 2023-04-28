<?php

namespace Ourvoice\Objects;

/**
 * Class Messages
 *
 * @package Ourvoice\Sdk\Objects
 */
class Message extends Base
{
    public $account_id;

    public $from;

    public $direction;

    public $body;

    public $to;

    public $status;

    public $cost;

    public $id;
}
