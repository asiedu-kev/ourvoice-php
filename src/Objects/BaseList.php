<?php

namespace Ourvoice\Objects;

/**
 * Class BaseList
 *
 * @package Ourvoice\Sdk\Objects
 */
class BaseList extends Base
{
    public $meta;
    public $links = [
        'first' => null,
        'previous' => null,
        'next' => null,
        'last' => null,
    ];

    public $data = [];
}
