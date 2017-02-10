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

        // $op1 = new Option('容器・容量', ['240ml', '500ml', '2L']);
        // $op2 = new Option('本数', ['1本', '24本']);

        $va1 = new Variant([
            'sku'     => 'sku1',
            'options' => [
                ['容器・容量', '240ml'],
                ['本数', '1本'],
            ],
            'price' => 130,
        ]);

        $va2 = new Variant([
            'sku'     => 'sku2',
            'options' => [
                ['容器・容量', '500ml'],
                ['本数', '1本'],
            ],
            'price' => 150,
        ]);

        $va3 = new Variant([
            'sku'     => 'sku3',
            'options' => [
                ['容器・容量', '240ml'],
                ['本数', '24本'],
            ],
            'price'           => 80 * 24,
            'reference_price' => 130 * 24,
        ]);

        $va4 = new Variant([
            'sku'     => 'sku4',
            'options' => [
                ['容器・容量', '500ml'],
                ['本数', '24本'],
            ],
            'price'           => 90 * 24,
            'reference_price' => 150 * 24,
        ]);

        $va5 = new Variant([
            'sku'     => 'sku5',
            'options' => [
                ['容器・容量', '2L'],
                ['本数', '24本'],
            ],
            'price'           => 110 * 24,
            'reference_price' => 200 * 24,
        ]);

        $product = new Product([
            'name' => $name,
            'description' => $description,
            'options' => ['容器・容量', '本数'],
            'variants' => [$va1, $va2, $va3, $va4],
        ]);

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
