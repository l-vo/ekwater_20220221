<?php

namespace App\Calculator;

use App\Entity\Product;

final class TotalPriceCalculator
{
    /**
     * @var array<string, ProductPriceCalculatorInterface>
     */
    private array $calculators = [];

    public function addCalculator(ProductPriceCalculatorInterface $calculator, string $category): void
    {
        $this->calculators[$category] = $calculator;
    }

    public function calculate(Product $product, int $quantity): int
    {
        $calculator = $this->calculators[$product->category] ?? ($this->calculators['all'] ?? null);

        $calculator ?? throw new \Exception(sprintf('No calculator found for category %s', $product->category));

        return $calculator->calculate($product, $quantity);
    }
}