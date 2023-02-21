<?php

namespace App\Calculator;

use App\Entity\Product;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.calculator', ['category' => 'sport'])]
final class SportCalculator implements ProductPriceCalculatorInterface
{
    public function calculate(Product $product, int $quantity): int
    {
        if ($quantity > 2) {
            $quantity--;
        }

        return $product->price * $quantity;
    }
}