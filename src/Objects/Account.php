<?php

namespace Ourvoice\Sdk\Objects;

/**
 * Class Account
 *
 * @package Ourvoice\Sdk\Objects
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
}
