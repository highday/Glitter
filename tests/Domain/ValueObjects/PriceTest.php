<?php

namespace Highday\Glitter\Domain\ValueObjects\Product;

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
        $price1 = new Price(100);
        $this->assertInstanceOf(Price::class, $price1);

        $price2 = new Price(1980, 2000);
        $this->assertInstanceOf(Price::class, $price2);
    }

    public function testGetValue()
    {
        $price1 = new Price(100);
        $this->assertEquals(100, $price1->getSelling());
        $this->assertNull($price1->getReference());

        $price2 = new Price(1980, 2000);
        $this->assertEquals(1980, $price2->getSelling());
        $this->assertEquals(2000, $price2->getReference());
    }

    public function testGetDifference()
    {
        $price1 = new Price(100);
        $this->assertEquals(0, $price1->getDifference());
        $this->assertEquals(0, $price1->getDifferencePercentage());

        $price2 = new Price(1980, 2000);
        $this->assertEquals(20, $price2->getDifference());
        $this->assertEquals(0.01, $price2->getDifferencePercentage());
    }
}
