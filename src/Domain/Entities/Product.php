<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\Collection;
use Highday\Glitter\Domain\Entity;
use Illuminate\Support\Arr;

class Product extends Entity
{
    /** @var Store */
    protected $store;

    /** @var string */
    protected $title;

    /** @var string */
    protected $description;

    /** @var Attachment */
    protected $thumbnail;

    /** @var Attachment[] */
    protected $attachments;

    /** @var string[] */
    protected $options;

    /** @var Variant[] */
    protected $variants;

    /** @var Customize[] */
    protected $customizes;

    /** @var Inventory */
    protected $inventory;

    /** @var Type */
    protected $type;

    /** @var Vendor */
    protected $vendor;

    public function __construct(array $props)
    {
        $props = array_filter($props);

        $this->title = Arr::get($props, 'title', '');
        $this->description = Arr::get($props, 'description', '');
        $this->thumbnail = Arr::exists($props, 'thumbnail')
            ? new Attachment(Arr::get($props, 'thumbnail'))
            : $this->defaultThumbnail();
        $this->images = self::newCollection(Arr::get($props, 'images', []));
        $this->options = Arr::get($props, 'options', []);
        $this->variants = self::newCollection(Arr::get($props, 'variants', []));
        $this->customizes = self::newCollection(Arr::get($props, 'customizes', []));
        $this->inventory = new Inventory();
        $this->type = new Type('R-type');
        $this->vendor = new Vendor('ven ven dor');
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getThumbnail(): Attachment
    {
        return $this->thumbnail;
    }

    public function getAttachments(): Collection
    {
        return $this->attachments;
    }

    public function getInventory(): Inventory
    {
        return $this->inventory;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function getVendor(): Vendor
    {
        return $this->vendor;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getVariants(): Collection
    {
        return $this->variants;
    }

    public function addVariant(Variant $variant)
    {
        $this->variants->add($variant);
    }

    public function countVariants(): int
    {
        return $this->variants->count();
    }

    public function stock()
    {
        $inventory_variants = $this->variants->filter(function ($variant) {
            return $variant->getInventoryManagement() != '';
        });

        if ($inventory_variants->count() > 0) {
            $quantity = $inventory_variants->map->getInventoryQuantity()->sum();
            $count = $this->variants->count();

            return "{$quantity} in stock for {$count} variants";
        } else {
            return;
        }
    }

    public function getCustomizes(): Collection
    {
        return $this->customizes;
    }

    public function defaultThumbnail(): Attachment
    {
        return new Attachment('http://placehold.jp/50x50.png');
    }
}
