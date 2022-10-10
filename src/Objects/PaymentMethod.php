<?php

namespace Ourvoice\Sdk\Objects;

/**
 * Class PaymentMethod
 *
 * @package Ourvoice\Sdk\Objects
 */
class PaymentMethod extends Base
{
    public $account_id;

    public $type;

    public $card_brand;

    public $last4;

    protected $exp_month;

    public $exp_year;

    public $phone_number;

    protected $id;
}
