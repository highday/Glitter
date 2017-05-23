<?php

namespace Glitter\Commerce\Order;

class Item
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var int
     */
    protected $quantity = 0;

    /**
     * @var float
     */
    protected $unitPrice = 0;

    /**
     * @var bool
     */
    protected $taxIncluded = false;

    /**
     * @var bool
     */
    protected $requiredShipment = false;

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $quantity
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param float $unitPrice
     *
     * @return $this
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * @param bool $taxIncluded
     *
     * @return $this
     */
    public function setTaxIncluded($taxIncluded)
    {
        $this->taxIncluded = $taxIncluded;

        return $this;
    }

    /**
     * @return bool
     */
    public function getTaxIncluded()
    {
        return $this->taxIncluded;
    }

    /**
     * @param bool $requiredShipment
     *
     * @return $this
     */
    public function setRequiredShipment($requiredShipment)
    {
        $this->requiredShipment = $requiredShipment;

        return $this;
    }

    /**
     * @return bool
     */
    public function getRequiredShipment()
    {
        return $this->requiredShipment;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->unitPrice * $this->quantity;
    }
}
