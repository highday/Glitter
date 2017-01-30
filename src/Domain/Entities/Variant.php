<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\Collection;
use Highday\Glitter\Domain\Entity;
use Highday\Glitter\Domain\ValueObjects\Money;
use Highday\Glitter\Domain\ValueObjects\Product\OptionValue;
use Highday\Glitter\Domain\ValueObjects\Product\Price;
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

    /** @var string */
    protected $inventory_policy;

    /** @var bool */
    protected $requires_shipping;

    public function __construct(array $props)
    {
        $this->image = array_get($props, 'image');
        if ($this->image instanceof Attachemnt) {
            throw new InvalidArgumentException();
        }

        $options = new Collection(array_get($props, 'options'));
        $this->options = $options->map(function ($option) {
            return new OptionValue($option[0], $option[1]);
        });

        $this->sku = (string) array_get($props, 'sku');

        $this->barcode = (string) array_get($props, 'barcode');

        $selling = new Money(array_get($props, 'price'));
        $reference = array_has($props, 'reference_price') ? new Money(array_get($props, 'reference_price')) : null;
        $taxes_included = array_get($props, 'taxes_included');
        $this->price = new Price($selling, $reference, $taxes_included);

        $this->inventory_management = (string) array_get($props, 'inventory_management');

        $this->inventory_quantity = (int) array_get($props, 'inventory_quantity');

        $this->inventory_policy = (string) array_get($props, 'inventory_policy');

        $this->requires_shipping = (bool) array_get($props, 'requires_shipping');
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

    public function getInventoryPolicy(): string
    {
        return $this->inventory_policy;
    }

    public function getRequiresShipping(): bool
    {
        return $this->requires_shipping;
    }
}
