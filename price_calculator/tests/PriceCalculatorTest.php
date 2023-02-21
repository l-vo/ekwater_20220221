<?php

namespace App\Tests;

use App\Calculator\ProductPriceCalculatorInterface;
use App\Calculator\TotalPriceCalculator;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class PriceCalculatorTest extends KernelTestCase
{
    public function testGenericProduct(): void
    {
        $this->bootKernel();

        $product = new Product('fish', 700, 'food');

        $price = self::getContainer()->get(TotalPriceCalculator::class)->calculate($product, 2);

        $this->assertSame(1400, $price);
    }

    public function testSportProduct(): void
    {
        $this->bootKernel();

        $product = new Product('shoes', 5000, 'sport');

        $price = self::getContainer()->get(TotalPriceCalculator::class)->calculate($product, 3);

        $this->assertSame(10000, $price);
    }

    public function testTechProduct(): void
    {
        $this->bootKernel();

        $product = new Product('usb storage', 6000, 'tech');

        $price = self::getContainer()->get(TotalPriceCalculator::class)->calculate($product, 1);

        $this->assertSame(5700, $price);
    }
}