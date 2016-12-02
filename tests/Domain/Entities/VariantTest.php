<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\ValueObjects\Product\OptionValue;
use Highday\Glitter\Domain\ValueObjects\Product\Price;
use PHPUnit\Framework\TestCase;

class VariantTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = \Faker\Factory::create('ja_JP');
    }

    public function testInstance()
    {
        $variant1 = new Variant();
        $this->assertInstanceOf(Variant::class, $variant1);

        $op1 = new Option('op1', ['op1']);
        $op2 = new Option('op2', ['op2']);
        $variant2 = new Variant('sku', [
            $op1->getValue('op1'),
            $op2->getValue('op2'),
        ], new Price(100, 120));
        $this->assertInstanceOf(Variant::class, $variant2);
    }

    public function testGetVariantOptions()
    {
        $variant = new Variant('sku', [
            new OptionValue('name1', 'value1'),
            new OptionValue('name2', 'value2'),
            new OptionValue('name3', 'value3'),
        ]);
        $options = $variant->getOptions();
        foreach ($options as $option) {
            $this->assertInstanceOf(OptionValue::class, $option);
        }
    }

    public function testSetVariantPrice()
    {
        $variant = new Variant();
        $variant->setPrice(new Price(100));
        $this->assertInstanceOf(Price::class, $variant->getPrice());
    }

    public function testGetVariantPrice()
    {
        $variant = new Variant('sku', [], new Price(100, 120));
        $price = $variant->getPrice();
        $this->assertInstanceOf(Price::class, $price);
    }
}
