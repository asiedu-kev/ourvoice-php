<?php

namespace Ourvoice\Sdk\Objects;

/**
 * Class BaseList
 *
 * @package Ourvoice\Sdk\Objects
 */
class BaseList extends Base
{
    public $limit;
    public $offset;
    public $count;
    public $totalCount;
    public $links = [
        'first' => null,
        'previous' => null,
        'next' => null,
        'last' => null,
    ];

    public $items = [];
}
