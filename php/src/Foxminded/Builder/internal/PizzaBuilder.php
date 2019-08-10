<?php
declare(strict_types=1);

namespace Kata\Foxminded\Builder\internal;

interface PizzaBuilder
{
    public function getCheese(): array;

    public function getPaper(): array;

    public function getVegetables(): array;
}
