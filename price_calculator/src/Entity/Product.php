<?php

namespace App\Entity;

final class Product
{
    public function __construct(
        public readonly string $name,
        public readonly int $price,
        public readonly string $category,
    ) {}
}