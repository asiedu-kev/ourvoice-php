<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Objects;

/**
 * Class Medias
 *
 * @package Ourvoice\Sdk\Resources
 */
class Medias extends Base
{
    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Media();
        $this->setResourceName('medias');

        parent::__construct($httpClient);
    }
}
