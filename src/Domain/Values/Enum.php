<?php

namespace Highday\Glitter\Domain\Values;

use InvalidArgumentException;
use ReflectionObject;

abstract class Enum
{
    private $scalar;

    public function __construct($value)
    {
        $ref = new ReflectionObject($this);
        $consts = $ref->getConstants();

        if (!in_array($value, $consts, true)) {
            throw new InvalidArgumentException("{$ref->name}: '{$value}' is not defined.");
        }

        $this->scalar = $value;
    }

    final public static function __callStatic($label, $args)
    {
        $class = get_called_class();
        $const = constant("{$class}::{$label}");

        return new $class($const);
    }

    final public function raw()
    {
        return $this->scalar;
    }

    final public function __toString(): string
    {
        return (string) $this->scalar;
    }
}
