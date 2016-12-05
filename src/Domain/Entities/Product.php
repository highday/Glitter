<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\{Entity, EntityCollection};

class Product extends Entity
{
    /** @var Store */
    protected $store;

    /** @var string */
    protected $name;

    /** @var string */
    protected $description;

    /** @var Image */
    protected $thumbnail;

    /** @var Image[] */
    protected $images;

    /** @var Variant[] */
    protected $variants;

    /** @var Inventory */
    protected $inventory;

    /** @var Type */
    protected $type;

    /** @var Vendor */
    protected $vendor;

    public function __construct(string $name, string $description = null, array $variants = [])
    {
        $this->name = $name;
        $this->description = $description;
        $this->thumbnail = $this->defaultThumbnail();
        $this->images = self::newCollection();
        $this->variants = self::newCollection($variants);
        $this->inventory = new Inventory();
        $this->type = new Type('R-type');
        $this->vendor = new Vendor('ven ven dor');
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getThumbnail(): Image
    {
        return $this->thumbnail;
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

    public function getVariants(): EntityCollection
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

    public function defaultThumbnail(): Image
    {
        return new Image('http://placehold.jp/50x50.png');
    }
}
