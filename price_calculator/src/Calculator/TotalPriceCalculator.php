<?php

namespace App\Calculator;

use App\Entity\Product;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Attribute\TaggedLocator;

final class TotalPriceCalculator
{
    public function __construct(#[TaggedLocator('app.calculator')] private ContainerInterface $container)
    {
    }

    public function calculate(Product $product, int $quantity): int
    {
        $calculator = $this->container->has($product->category)
            ? $this->container->get($product->category)
            : ($this->container->has('all') ? $this->container->get('all') : null)
        ;

        $calculator ?? throw new \Exception(sprintf('No calculator found for category %s', $product->category));

        return $calculator->calculate($product, $quantity);
    }
}