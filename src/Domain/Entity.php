<?php

namespace Highday\Glitter\Domain;

abstract class Entity
{
    /** @var int|string */
    protected $identifier;

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function equals($entity)
    {
        if (!($entity instanceof self)) {
            return false;
        }

        return $this->identifier === $entity->identifier;
    }

    public static function newCollection(array $entities = [])
    {
        return new EntityCollection($entities);
    }

    public function clone()
    {
        return clone $this;
    }

    public function __clone()
    {
        //
    }
}
