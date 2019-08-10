<?php
declare(strict_types=1);

namespace Kata\Foxminded\AbstractFactory\contracts;

// abstract factory
interface LunchFactory
{
    public function createDish(): Dish;

    public function createDesert(): Dessert;
}

