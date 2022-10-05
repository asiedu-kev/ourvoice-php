<?php

namespace Ourvoice\Sdk\Objects;

use stdClass;

/**
 * Class Contact
 *
 * @package Ourvoice\Sdk\Objects
 */
class Contact extends Base
{
    
    public $first_name;
   
    public $firstName;
    
    public $last_name;
    
    public $phone_number;
    
    public $language;
   
    public $custom_fields;
    
    public $account_id;
    
    protected $id;
   


   
    protected $createdDatetime;

    /**
     * The date and time of the updated of the contact in RFC3339 format (Y-m-d\TH:i:sP)
     *
     * @var string|null
     */
    protected $updatedDatetime;

    public function getId(): string
    {
        return $this->id;
    }
    public function getGroups(): stdClass
    {
        return $this->groups;
    }
    public function getCreatedDatetime(): string
    {
        return $this->createdDatetime;
    }

    public function getUpdatedDatetime(): ?string
    {
        return $this->updatedDatetime;
    }

    

}
