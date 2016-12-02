<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\Entity;

class Product extends Entity
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $description;

    // /** @var Store */
    // protected $store;

    // /** @var Image[] */
    // protected $images;

    /** @var Variant[] */
    protected $variants;

    // /** @var Vendor */
    // protected $vendor;

    public function __construct(string $name, string $description = null, array $variants = [])
    {
        $this->name = $name;
        $this->description = $description;
        $this->variants = self::newCollection($variants);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function addVariant(Variant $variant)
    {
        $this->variants->add($variant);
    }

    public function countVariants(): int
    {
        return $this->variants->count();
    }
}
