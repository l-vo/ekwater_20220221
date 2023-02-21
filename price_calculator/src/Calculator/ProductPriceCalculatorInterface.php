<?php

namespace App\Calculator;

use App\Entity\Product;

interface ProductPriceCalculatorInterface
{
    public function calculate(Product $product, int $quantity): int;
}