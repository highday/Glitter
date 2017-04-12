<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\Values\Product\OptionValue;
use Highday\Glitter\Domain\Values\Product\Price;
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
        $variant1 = new Variant([]);
        $this->assertInstanceOf(Variant::class, $variant1);

        $variant2 = new Variant([
            'sku'     => 'sku',
            'options' => [
                ['op1', 'op1'],
                ['op2', 'op2'],
            ],
            'price'           => 100,
            'reference_price' => 120,
        ]);
        $this->assertInstanceOf(Variant::class, $variant2);
    }

    public function testGetVariantOptions()
    {
        $variant = new Variant([
            'sku'     => 'sku',
            'options' => [
                ['name1', 'value1'],
                ['name2', 'value2'],
                ['name3', 'value3'],
            ],
        ]);
        $options = $variant->getOptions();
        foreach ($options as $option) {
            $this->assertInstanceOf(OptionValue::class, $option);
        }
    }

    public function testGetVariantPrice()
    {
        $variant = new Variant([
            'sku'             => 'sku',
            'options'         => [],
            'price'           => 100,
            'reference_price' => 120,
        ]);
        $price = $variant->getPrice();
        $this->assertInstanceOf(Price::class, $price);
    }
}
