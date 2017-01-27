<?php

namespace Highday\Glitter\Domain\ValueObjects;

class Money
{
    /** @var float */
    protected $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function add(Money $money): Money
    {
        $amount = $this->amount + $money->getAmount();

        return $this->newMoney($amount);
    }

    public function subtract(Money $money): Money
    {
        $amount = $this->amount - $money->getAmount();

        return $this->newMoney($amount);
    }

    public function multiply(float $factor): Money
    {
        $amount = $this->amount * $factor;

        return $this->newMoney($amount);
    }

    public function divide(float $factor): Money
    {
        $amount = $this->amount / $factor;

        return $this->newMoney($amount);
    }

    private function newMoney(float $amount): Money
    {
        return new static($amount);
    }

    public function __toString(): string
    {
        return number_format($this->amount);
    }
}
