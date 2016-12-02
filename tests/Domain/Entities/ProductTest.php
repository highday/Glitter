<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\ValueObjects\Product\Price;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = \Faker\Factory::create('ja_JP');
    }

    public function testInstance()
    {
        $name = 'お茶';
        $description = 'ペットボトルに入ったお茶です。';

        $op1 = new Option('容器・容量', ['240ml', '500ml', '2L']);
        $op2 = new Option('本数', ['1本', '24本']);

        $va1 = new Variant('sku1', [
            $op1->getValue('240ml'),
            $op2->getValue('1本')
        ], new Price(130));

        $va2 = new Variant('sku2', [
            $op1->getValue('500ml'),
            $op2->getValue('1本')
        ], new Price(150));

        $va3 = new Variant('sku3', [
            $op1->getValue('240ml'),
            $op2->getValue('24本')
        ], new Price(80*24, 130*24));

        $va4 = new Variant('sku4', [
            $op1->getValue('500ml'),
            $op2->getValue('24本')
        ], new Price(90*24, 150*24));

        $va5 = new Variant('sku5', [
            $op1->getValue('2L'),
            $op2->getValue('24本')
        ], new Price(110*24, 200*24));

        $product = new Product($name, $description, [$va1, $va2, $va3, $va4]);

        $product->addVariant($va5);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals($name, $product->getName());
        $this->assertEquals($description, $product->getDescription());

        return $product;
    }

    /**
     * @depends testInstance
     */
    public function testTotalVariantCount(Product $product)
    {
        $this->assertEquals(5, $product->countVariants());
    }
}
