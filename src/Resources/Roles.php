<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Objects;

/**
 * Class Roles
 *
 * @package Ourvoice\Sdk\Resources
 */
class Roles extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Role();
        $this->setResourceName('roles');

        parent::__construct($httpClient);
    }
}
