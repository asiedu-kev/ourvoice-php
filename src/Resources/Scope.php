<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Scope
 *
 * @package Ourvoice\Sdk\Resources
 */
class Scope extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Scope();
        $this->setResourceName('scopes');

        parent::__construct($httpClient);
    }
}
