<?php

namespace Highday\Glitter\Domain\ValueObjects;

use ReflectionObject;
use InvalidArgumentException;

abstract class Enum
{
    private $scalar;

    function __construct($value)
    {
        if ($value instanceof self) {
            return $value;
        }

        $ref = new ReflectionObject($this);
        $consts = $ref->getConstants();

        if (! in_array($value, $consts, true)) {
            throw new InvalidArgumentException("{$ref->name}: '{$value}' is not defined.");
        }

        $this->scalar = $value;
    }

    final function __call($label, $args)
    {
        $class = get_called_class();
        if (str_is('is*', $label)) {
            $label = preg_replace('/^is/', '', $label);
            return $this->raw() === constant("{$class}::{$label}");
        }
    }

    final static function __callStatic($label, $args)
    {
        $class = get_called_class();
        $const = constant("{$class}::{$label}");
        return new $class($const);
    }

    final function raw()
    {
        return $this->scalar;
    }

    final function __toString()
    {
        $class = class_basename(get_called_class());
        $raw = $this->raw();

        $key = "code.{$class}.{$raw}";
        if (Lang::has($key)) {
            return Lang::get($key);
        }

        $key = "code.{$class}.units";
        if (is_numeric($raw) && Lang::has($key)) {
            return Lang::get($key, ['value' => number_format($raw)]);
        }

        $key = "code.{$class}.format";
        if (Lang::has($key)) {
            return Lang::get($key, ['value' => $raw]);
        }

        return (string) $raw;
    }

    public static function toArray()
    {
        $array = [];
        foreach (self::all() as $const) {
            $array[] = $const->raw();
        }
        return $array;
    }

    public static function all()
    {
        $class = get_called_class();
        $ref = new ReflectionClass($class);
        $consts = [];
        foreach ($ref->getConstants() as $const => $value) {
            $consts[] = $class::$const();
        }
        return $consts;
    }

    public static function consts()
    {
        return self::all();
    }

}
