<?php

namespace Highday\Glitter\Domain\ValueObjects\Product;

class OptionValue
{
    protected $name;

    protected $value;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;

        $this->value = $value;
    }
}
