<?php

namespace Highday\Glitter\Domain\ValueObjects\Product;

use Highday\Glitter\Domain\ValueObjects\Money;

class Price
{
    /** @var Money */
    protected $selling;

    /** @var Money|null */
    protected $reference;

    public function __construct(Money $selling, Money $reference = null)
    {
        $this->selling = $selling;
        $this->reference = $reference;
    }

    public function getSelling(): Money
    {
        return $this->selling;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function getDifference(): Money
    {
        if (is_null($this->reference)) {
            return new Money(0);
        }

        return $this->reference->subtract($this->selling);
    }

    public function getDifferencePercentage(): float
    {
        if (is_null($this->reference) || $this->reference->getAmount() == 0) {
            return 0;
        }

        $difference = $this->getDifference();

        return $difference->getAmount() > 0 ? $difference->getAmount() / $this->reference->getAmount() : 0;
    }
}
