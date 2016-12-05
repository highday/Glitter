<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\Entity;

class Store extends Entity
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
