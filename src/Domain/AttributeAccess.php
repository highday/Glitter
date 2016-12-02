<?php

namespace Highday\Glitter\Domain;

trait AttributeAccess
{
    protected $attributes = [];

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function __get($key)
    {
        return $this->attributes[$key];
    }
}
