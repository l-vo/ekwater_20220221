<?php

namespace App\Calculator;

use App\Entity\Product;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.calculator', ['category' => 'all'])]
final class GenericCalculator implements ProductPriceCalculatorInterface
{
    public function calculate(Product $product, int $quantity): int
    {
        return $product->price * $quantity;
    }
}