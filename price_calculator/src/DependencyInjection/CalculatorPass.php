<?php

namespace App\DependencyInjection;

use App\Calculator\TotalPriceCalculator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class CalculatorPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition(TotalPriceCalculator::class)) {
            return;
        }

        $totalPriceCalculator = $container->getDefinition(TotalPriceCalculator::class);
        $calculators = $container->findTaggedServiceIds('app.calculator');

        foreach ($calculators as $id => $attributes) {
            $totalPriceCalculator->addMethodCall('addCalculator', [new Reference($id), $attributes[0]['category'] ?? 'all']);
        }
    }
}