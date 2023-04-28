<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Objects;

/**
 * Class Users
 *
 * @package Ourvoice\Sdk\Resources
 */
class Users extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\User();
        $this->setResourceName('users');

        parent::__construct($httpClient);
    }
}
