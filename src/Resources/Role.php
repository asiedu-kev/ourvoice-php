<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Role
 *
 * @package Ourvoice\Sdk\Resources
 */
class Role extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Role();
        $this->setResourceName('roles');

        parent::__construct($httpClient);
    }
}
