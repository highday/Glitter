<?php

namespace Glitter\Commerce\Shipping;

use Glitter\Commerce\Support\Address;

class Tag
{
    /**
     * @var string
     */
    protected $method = 'manual';

    /**
     * @var \Glitter\Commerce\Support\Address
     */
    protected $address;

    /**
     * @var string
     */
    protected $trackingNumber = '';

    /**
     * @var float
     */
    protected $fee = 0;

    /**
     * @param  string  $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param  \Glitter\Commerce\Support\Address $address
     * @return $this
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return \Glitter\Commerce\Support\Address | null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param  string  $trackingNumber
     * @return $this
     */
    public function setTrackingNumber($trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }

    /**
     * @param  float  $fee
     * @return $this
     */
    public function setFee($fee)
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * @return float
     */
    public function getFee()
    {
        return $this->fee;
    }
}
