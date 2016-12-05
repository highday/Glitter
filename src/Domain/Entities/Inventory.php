<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\Entity;

class Inventory extends Entity
{
    public $array;

    public function __construct()
    {
        $this->array = [];
    }

    public function getSummary(): string
    {
        return '60個（7種類）';
    }
}
