<?php

namespace Highday\Glitter\Domain\Values;

use InvalidArgumentException;

class EmailAddress
{
    protected $value;

    public function __construct($value)
    {
        $value = filter_var($value, FILTER_VALIDATE_EMAIL);

        if ($value === false) {
            throw new InvalidArgumentException();
        }

        $this->value = $value;
    }

    public function toRawValue()
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->toRawValue();
    }
}
