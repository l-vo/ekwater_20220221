<?php

namespace App\Calculator;

use App\Entity\Product;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.calculator')]
interface ProductPriceCalculatorInterface
{
    public function calculate(Product $product, int $quantity): int;
}