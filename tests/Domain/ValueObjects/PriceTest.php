<?php

namespace Highday\Glitter\Domain\ValueObjects\Product;

use Highday\Glitter\Domain\ValueObjects\Money;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = \Faker\Factory::create('ja_JP');
    }

    public function testInstance()
    {
        $price1 = new Price(new Money(100));
        $this->assertInstanceOf(Price::class, $price1);

        $price2 = new Price(new Money(1980), new Money(2000));
        $this->assertInstanceOf(Price::class, $price2);
    }

    public function testGetValue()
    {
        $price1 = new Price(new Money(100));
        $this->assertEquals(100, $price1->getSelling()->getAmount());
        $this->assertNull($price1->getReference());

        $price2 = new Price(new Money(1980), new Money(2000));
        $this->assertEquals(1980, $price2->getSelling()->getAmount());
        $this->assertEquals(2000, $price2->getReference()->getAmount());
    }

    public function testGetDifference()
    {
        $price1 = new Price(new Money(100));
        $this->assertEquals(0, $price1->getDifference()->getAmount());
        $this->assertEquals(0, $price1->getDifferencePercentage());

        $price2 = new Price(new Money(1980), new Money(2000));
        $this->assertEquals(20, $price2->getDifference()->getAmount());
        $this->assertEquals(0.01, $price2->getDifferencePercentage());
    }
}
