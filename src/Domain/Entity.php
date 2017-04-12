<?php

namespace Highday\Glitter\Domain;

use DomainException;
use Illuminate\Support\Str;

abstract class Entity
{
    /** @var int|string */
    protected $identifier;

    public function setId($identifier)
    {
        $this->identifier = $identifier;
    }

    public function getId()
    {
        return $this->identifier;
    }

    public function equals($entity)
    {
        if (!($entity instanceof self)) {
            return false;
        }

        return $this->getId() === $entity->getId();
    }

    public static function newCollection(array $entities = [])
    {
        return new Collection($entities);
    }

    public function clone()
    {
        return clone $this;
    }

    public function __clone()
    {
        //
    }

    public function __get($key)
    {
        $method = Str::camel("get_{$key}");

        if (method_exists($this, $method) == false) {
            throw new DomainException("Unknown entity property : {$key}");
        }

        return $this->{$method}();
    }
}
