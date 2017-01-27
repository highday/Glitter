<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\Collection;
use Highday\Glitter\Domain\Entity;
use Highday\Glitter\Domain\ValueObjects\Money;
use Highday\Glitter\Domain\ValueObjects\Product\OptionValue;
use Highday\Glitter\Domain\ValueObjects\Product\Price;

class Variant extends Entity
{
    /** @var string */
    protected $sku;

    /** @var OptionValue[] */
    protected $options;

    /** @var Price */
    protected $price;

    // /** @var Stock */
    // protected $stock;

    public function __construct(string $sku, array $options, float $price, float $reference_price = null)
    {
        $this->sku = $sku;
        $this->options = (new Collection($options))->map(function ($option) {
            return new OptionValue($option[0], $option[1]);
        });
        $this->price = new Price(new Money($price), $reference_price ? new Money($reference_price) : null);
    }

    public function setSKU(string $sku)
    {
        $this->sku = $sku;
    }

    public function getSKU(): string
    {
        return $this->sku;
    }

    public function addOption(Option $option)
    {
        $this->options->push($option);
    }

    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function setPrice(Price $price)
    {
        $this->price = $price;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }
}
