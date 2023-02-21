<?php

namespace App\Calculator;

use App\Entity\Product;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('sport')]
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