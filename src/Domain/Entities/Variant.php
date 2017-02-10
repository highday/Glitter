<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\Collection;
use Highday\Glitter\Domain\Entity;
use Highday\Glitter\Domain\ValueObjects\Money;
use Highday\Glitter\Domain\ValueObjects\Product\OptionValue;
use Highday\Glitter\Domain\ValueObjects\Product\Price;
use Highday\Glitter\Domain\ValueObjects\Product\Weight;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class Variant extends Entity
{
    /** @var Attachemnt */
    protected $image;

    /** @var string */
    protected $sku;

    /** @var OptionValue[] */
    protected $options;

    /** @var Price */
    protected $price;

    /** @var string */
    protected $inventory_management;

    /** @var int */
    protected $inventory_quantity;

    /** @var bool */
    protected $out_of_stock_purchase;

    /** @var bool */
    protected $requires_shipping;

    /** @var Weight */
    protected $weight;

    /** @var string */
    protected $fulfillment_service;

    public function __construct(array $props)
    {
        $props = array_filter($props);

        $this->image = Arr::get($props, 'image');
        if ($this->image instanceof Attachemnt) {
            throw new InvalidArgumentException();
        }

        $options = new Collection(Arr::get($props, 'options', []));
        $this->options = $options->map(function ($option) {
            return new OptionValue($option[0], $option[1]);
        });

        $this->sku = Arr::get($props, 'sku', '');
        $this->barcode = Arr::get($props, 'barcode', '');

        $this->price = new Price(
            new Money(Arr::get($props, 'price', 0)),
            Arr::exists($props, 'reference_price')
                ? new Money(Arr::get($props, 'reference_price', 0))
                : null,
            Arr::get($props, 'taxes_included', false)
        );

        $this->inventory_management = Arr::get($props, 'inventory_management', '');
        $this->inventory_quantity = Arr::get($props, 'inventory_quantity', 0);
        $this->out_of_stock_purchase = Arr::get($props, 'out_of_stock_purchase', false);
        $this->requires_shipping = Arr::get($props, 'requires_shipping', false);
        $this->weight = new Weight(
            Arr::get($props, 'weight', 0),
            Arr::get($props, 'weight_unit', '')
        );
        $this->fulfillment_service = Arr::get($props, 'fulfillment_service', '');
    }

    public function getSKU(): string
    {
        return $this->sku;
    }

    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function getInventoryManagement(): string
    {
        return $this->inventory_management;
    }

    public function getInventoryQuantity(): int
    {
        return $this->inventory_quantity;
    }

    public function getOutOfStockPurchase(): bool
    {
        return $this->out_of_stock_purchase;
    }

    public function getRequiresShipping(): bool
    {
        return $this->requires_shipping;
    }

    public function getWeight(): Weight
    {
        return $this->weight;
    }

    public function getFulfillmentService(): string
    {
        return $this->fulfillment_service;
    }
}
