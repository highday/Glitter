<?php

namespace Highday\Glitter\Domain;

use Highday\Glitter\Domain\Collection as BaseCollection;
use Illuminate\Support\Arr;

class EntityCollection extends BaseCollection
{
    /**
     * Find a entity in the collection by identifier.
     *
     * @param mixed $identifier
     * @param mixed $default
     *
     * @return \Highday\Glitter\Domain\Entity
     */
    public function find($identifier, $default = null)
    {
        if ($identifier instanceof Entity) {
            $identifier = $identifier->getIdentifier();
        }

        return Arr::first($this->items, function ($entity) use ($identifier) {
            return $entity->getIdentifier() == $identifier;
        }, $default);
    }

    /**
     * Add an item to the collection.
     *
     * @param mixed $item
     *
     * @return $this
     */
    public function add($item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Determine if a identifier exists in the collection.
     *
     * @param mixed $identifier
     * @param mixed $value
     *
     * @return bool
     */
    public function contains($identifier, $value = null)
    {
        if (func_num_args() == 2) {
            return parent::contains($identifier, $value);
        }

        if ($this->useAsCallable($identifier)) {
            return parent::contains($identifier);
        }

        $identifier = $identifier instanceof Entity ? $identifier->getIdentifier() : $identifier;

        return parent::contains(function ($entity) use ($identifier) {
            return $entity->getIdentifier() == $identifier;
        });
    }

    /**
     * Get the array of identifiers.
     *
     * @return array
     */
    public function entityIdentifiers()
    {
        return array_map(function ($entity) {
            return $entity->getIdentifier();
        }, $this->items);
    }
}
