<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Invitation
 *
 * @package Ourvoice\Sdk\Resources
 */
class Invitation extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Invitation();
        $this->setResourceName('invitations');

        parent::__construct($httpClient);
    }
}
