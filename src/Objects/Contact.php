<?php

namespace Ourvoice\Objects;

use stdClass;

/**
 * Class Contact
 *
 * @package Ourvoice\Sdk\Objects
 */
class Contact extends Base
{
    
    public $first_name;
    
    public $last_name;
    
    public $phone_number;
    
    public $language;
   
    public $custom_fields;
    
    public $account_id;
    
    protected $id;
   


   
    protected $createdDatetime;

    protected $updatedDatetime;

    public function getId(): string
    {
        return $this->id;
    }
    public function getGroups(): stdClass
    {
        return $this->groups;
    }
    

    

}
