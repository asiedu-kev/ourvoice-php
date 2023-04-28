<?php

namespace Ourvoice\Objects;

use stdClass;

/**
 * Class Base
 *
 * @package Ourvoice\Sdk\Objects
 */
class Base
{
    
    public function loadFromArray($object)
    {
        if ($object) {
            foreach ($object as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
        return $this;
    }

    /**
     * @param stdClass $object
     * @return self
     */
    public function loadFromStdclass(stdClass $object)
    {
        foreach ($object as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
        return $this;
    }
}
