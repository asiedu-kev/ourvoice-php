<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Message
 *
 * @package Ourvoice\Sdk\Resources
 */
class Message extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Message();
        $this->setResourceName('messages');

        parent::__construct($httpClient);
    }
}
