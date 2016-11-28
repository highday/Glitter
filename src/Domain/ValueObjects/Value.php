<?php

namespace Highday\Glitter\Domain\ValueObjects;

interface Value
{
    public function toRawValue();

    public function __toString(): string;
}
