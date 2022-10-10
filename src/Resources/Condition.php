<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Condition
 *
 * @package Ourvoice\Sdk\Resources
 */
class Condition extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Condition();
        $this->setResourceName('conditions');

        parent::__construct($httpClient);
    }
}
