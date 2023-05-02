<?php

namespace Ourvoice\Objects;

/**
 * Class Plan
 *
 * @package Ourvoice\Sdk\Objects
 */
class Plan extends Base
{
    public $name;

    public $description;

    public $price;

    public $voices;

    public $sms;

    public $cost_by_sms;

    public $cost_by_voice;

    public $id;
}
