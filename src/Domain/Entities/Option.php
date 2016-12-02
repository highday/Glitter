<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\Entity;
use Highday\Glitter\Domain\ValueObjects\Product\OptionValue;
use InvalidArgumentException;

class Option extends Entity
{
    /** @var string */
    protected $name;

    /** @var string[] */
    protected $values;

    public function __construct(string $name, array $values)
    {
        $this->name = $name;
        $this->values = $values;
    }

    public function getValue(string $value)
    {
        if (! in_array($value, $this->values)) {
            throw new InvalidArgumentException();
        }

        return new OptionValue($this->name, $value);
    }
}
