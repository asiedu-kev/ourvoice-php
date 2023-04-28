<?php

namespace Ourvoice\Resources;

use Ourvoice\Common;
use Ourvoice\Objects;

/**
 * Class Contacts
 *
 * @package Ourvoice\Sdk\Resources
 */
class Contacts extends Base
{
    

    public function __construct(Common\HttpClient $httpClient)
    {
        $this->object = new Objects\Contact();
        $this->setResourceName('contacts');

        parent::__construct($httpClient);
    }

   
}
