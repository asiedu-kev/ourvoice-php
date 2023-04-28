<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Objects;

/**
 * Class Invitation
 *
 * @package Ourvoice\Sdk\Resources
 */
class Invitations extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Invitation();
        $this->setResourceName('invitations');

        parent::__construct($httpClient);
    }
}
