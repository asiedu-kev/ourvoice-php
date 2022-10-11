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

    /**
     * Get the created id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the created href
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * Get the $createdDatetime value
     */
    public function getCreatedDatetime(): string
    {
        return $this->createdDatetime;
    }

    /**
     * Get the $updatedDatetime value
     */
    public function getUpdatedDatetime(): ?string
    {
        return $this->createdDatetime;
    }

    public function getContacts(): stdClass
    {
        return $this->contacts;
    }

    /**
     * @deprecated 2.2.0 No longer used by internal code, please switch to {@see self::loadFromStdclass()}
     * 
     * @param mixed $object
     *
     * @return $this|void
     */
    public function loadFromArray($object): self
    {
        return parent::loadFromArray($object);
    }

    public function loadFromStdclass(stdClass $object): self
    {
        return parent::loadFromStdclass($object);
    }
}
