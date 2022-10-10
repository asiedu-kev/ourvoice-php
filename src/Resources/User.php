<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class User
 *
 * @package Ourvoice\Sdk\Resources
 */
class User extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\User();
        $this->setResourceName('users');

        parent::__construct($httpClient);
    }
}
