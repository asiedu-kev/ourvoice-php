<?php


namespace Ourvoice;


class Values implements \ArrayAccess {
    public const NONE = 'Ourvoice\\Values\\NONE';
    public const ARRAY_NONE = [self::NONE];

    protected $options;

    public static function array_get(array $array, string $key, string $default = null) {
        if (\array_key_exists($key, $array)) {
            return $array[$key];
        }
        return $default;
    }

    public static function of(array $array): array {
        $result = [];
        foreach ($array as $key => $value) {
            if ($value !== self::NONE && $value !== self::ARRAY_NONE) {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    public function __construct(array $options) {
        $this->options = [];
        foreach ($options as $key => $value) {
            $this->options[\strtolower($key)] = $value;
        }
    }

 
    public function offsetExists($offset): bool {
        return true;
    }

    public function offsetGet($offset) {
        $offset = \strtolower($offset);
        return \array_key_exists($offset, $this->options) ? $this->options[$offset] : self::NONE;
    }


    public function offsetSet($offset, $value): void {
        $this->options[\strtolower($offset)] = $value;
    }

  
    public function offsetUnset($offset): void {
        unset($this->options[$offset]);
    }
}
