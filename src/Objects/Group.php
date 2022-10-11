<?php

namespace Ourvoice\Sdk\Objects;

use stdClass;

/**
 * Class Group
 *
 * @package Ourvoice\Sdk\Objects
 */
class Group extends Base
{
   
    public $name;

    public $description;

    public $account_id;

    public $id;


    protected $contacts = null;

    protected $createdDatetime;

    protected $updatedDatetime;

    public function getId(): string
    {
        return $this->id;
    }

    public function getContacts(): stdClass
    {
        return $this->contacts;
    }

    
}
