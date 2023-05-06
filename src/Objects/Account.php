<?php

namespace Ourvoice\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Objects
 */
class Account extends Base
{
    public $id;
    public $name;
    public $status;
    public $balance;
    public $currency;
    public $owner_id;
    public $settings;
    public $country;
    public $timezone;
    public $city;
    public $region;
    public $sms_available;
    public $vioces_available;
    public $subscriptions;
}
