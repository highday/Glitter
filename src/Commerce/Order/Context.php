<?php

namespace Glitter\Commerce\Order;

use Glitter\Commerce\Order\Box;
use Glitter\Contracts\Commerce\Order\Context as ContextContract;

class Context implements ContextContract
{
    /**
     * @var \Glitter\Commerce\Order\Box[]
     */
    protected $boxes = [];

    /**
     * @var string
     */
    protected $status = 'inbox';

    /**
     * @var \Carbon\Carbon
     */
    protected $orderedAt;

    /**
     * @var string
     */
    protected $note = '';

    /**
     * @var array
     */
    protected $discounts = [];

    /**
     * @param  \Glitter\Commerce\Order\Box  $box
     * @return $this
     */
    public function pushBox(Box $box)
    {
        array_push($this->boxes, $box);

        return $this;
    }

    /**
     * @return \Glitter\Commerce\Order\Box[]
     */
    public function getBoxes()
    {
        return $this->boxes;
    }

    /**
     * @param  string  $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param  \Carbon\Carbon  $orderedAt
     * @return void
     */
    public function setOrderedAt(Carbon $orderedAt)
    {
        $this->orderedAt = $orderedAt;
    }

    /**
     * @return \Carbon\Carbon | null
     */
    public function getOrderedAt()
    {
        return $this->orderedAt;
    }

    /**
     * @param  string  $note
     * @return void
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @return float
     */
    public function getShippingFee()
    {
        $fee = 0;
        foreach ($this->boxes as $box) {
            $fee += $box->getShippingFee();
        }

        return $fee;
    }

    /**
     * @return float
     */
    public function getDiscountPirce()
    {
        $price = 0;
        // foreach ($this->discounts as $discount) {
            $price += -1500;
        // }

        return $price;
    }

    /**
     * @return float
     */
    public function getTotalPirce()
    {
        $price = 0;
        foreach ($this->boxes as $box) {
            foreach ($box as $item) {
                $price += $item->getPrice();
            }
        }

        $price += $this->getShippingFee();
        $price += $this->getDiscountPirce();

        return $price;
    }
}
