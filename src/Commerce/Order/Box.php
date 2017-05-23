<?php

namespace Glitter\Commerce\Order;

use ArrayAccess;
use ArrayIterator;
use Countable;
use Glitter\Commerce\Shipping\Tag as ShippingTag;
use IteratorAggregate;

class Box implements ArrayAccess, Countable, IteratorAggregate
{
    /**
     * @var \Glitter\Commerce\Order\Item[]
     */
    protected $items = [];

    /**
     * @var \Glitter\Commerce\Shipping\Tag
     */
    protected $shippingTag;

    /**
     * @param \Glitter\Commerce\Order\Item $item
     *
     * @return $this
     */
    public function pushItem(Item $item)
    {
        $this->offsetSet(null, $item);

        return $this;
    }

    /**
     * @param \Glitter\Commerce\Shipping\Tag $shippingTag
     *
     * @return $this
     */
    public function setShippingTag(ShippingTag $shippingTag)
    {
        $this->shippingTag = $shippingTag;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasShippingTag()
    {
        return $this->shippingTag instanceof ShippingTag;
    }

    /**
     * @return \Glitter\Commerce\Shipping\Tag | null
     */
    public function getShippingTag()
    {
        return $this->shippingTag;
    }

    /**
     * @return float
     */
    public function getShippingFee()
    {
        if ($this->hasShippingTag() === false) {
            return 0;
        }

        return $this->getShippingTag()->getFee();
    }

    /**
     * @return float
     */
    public function getSubtotal(): float
    {
        return array_reduce($this->items, function ($result, $item) {
            return $result + $item->getPrice();
        }, 0);
    }

    /**
     * Get an iterator for the items.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Determine if an item exists at an offset.
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->items);
    }

    /**
     * Get an item at a given offset.
     *
     * @param mixed $key
     *
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->items[$key];
    }

    /**
     * Set the item at a given offset.
     *
     * @param mixed $key
     * @param mixed $value
     *
     * @return void
     */
    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    /**
     * Unset the item at a given offset.
     *
     * @param string $key
     *
     * @return void
     */
    public function offsetUnset($key)
    {
        unset($this->items[$key]);
    }
}
