<?php

namespace Ourvoice\Sdk\Resources;

use InvalidArgumentException;
use Ourvoice\Sdk\Common;
use Ourvoice\Sdk\Exceptions;
use Ourvoice\Sdk\Objects;
use Ourvoice\Sdk\Resources\Messages;

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
