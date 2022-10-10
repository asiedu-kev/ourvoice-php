<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Action
 *
 * @package Ourvoice\Sdk\Resources
 */
class Action extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Action();
        $this->setResourceName('actions');

        parent::__construct($httpClient);
    }
}
