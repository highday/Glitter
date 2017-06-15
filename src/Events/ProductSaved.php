<?php

namespace Glitter\Events;

class ProductSaved
{
    /**
     * The actor member.
     *
     * @var \Glitter\Eloquent\Models\Member|null
     */
    public $actor;

    /**
     * The save product.
     *
     * @var \Glitter\Eloquent\Models\Product
     */
    public $product;

    /**
     * Create a new event instance.
     *
     * @param  \Glitter\Eloquent\Models\Product  $product
     */
    public function __construct($product)
    {
        $this->actor = auth('member')->user();

        $this->product = $product;
    }
}
