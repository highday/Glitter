<?php

namespace Highday\Glitter\Domain\ValueObjects\Product;

class Price
{
    protected $selling;

    protected $reference;

    public function __construct(float $selling, float $reference = null)
    {
        $this->selling = $selling;
        $this->reference = $reference;
    }

    public function getSelling(): float
    {
        return $this->selling;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function getDifference(): float
    {
        return $this->reference > 0 ? $this->reference - $this->selling : 0;
    }

    public function getDifferencePercentage(): float
    {
        return $this->reference > 0 ? $this->getDifference() / $this->reference : 0;
    }
}
