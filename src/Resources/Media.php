<?php

namespace Ourvoice\Sdk\Resources;

use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Objects;

/**
 * Class Media
 *
 * @package Ourvoice\Sdk\Resources
 */
class Media extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Media();
        $this->setResourceName('medias');

        parent::__construct($httpClient);
    }
}
