<?php

namespace Ourvoice\Sdk\Objects;

/**
 * Class Balance
 *
 * @package Ourvoice\Sdk\Objects
 */
class Balance extends Base
{
    public $account_id;

    public $currency;

    public $amount;

    public $available_credit;

    protected $id;
}
