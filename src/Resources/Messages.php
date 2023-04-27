<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Messages
 *
 * @package Ourvoice\Sdk\Resources
 */
class Messages extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Message();
        $this->setResourceName('messages');

        parent::__construct($httpClient);
    }
}
