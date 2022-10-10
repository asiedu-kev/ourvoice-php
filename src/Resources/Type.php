<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Type
 *
 * @package Ourvoice\Sdk\Resources
 */
class Type extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Type();
        $this->setResourceName('types');

        parent::__construct($httpClient);
    }
}
