<?php

namespace Highday\Glitter\Domain\ValueObjects\Product;

use Highday\Glitter\Domain\ValueObjects\Money;

class Weight
{
    /** @var float */
    protected $amount;

    /** @var string */
    protected $unit;

    public function __construct(float $amount, string $unit)
    {
        $this->amount = $amount;
        $this->unit = $unit;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function __toString(): string
    {
        return sprintf('%s %s', $this->amount, $this->unit);
    }
}
