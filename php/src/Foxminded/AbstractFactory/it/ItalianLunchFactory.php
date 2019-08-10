<?php
declare(strict_types=1);

namespace Kata\Foxminded\AbstractFactory\it;

use Kata\Foxminded\AbstractFactory\contracts\Dessert;
use Kata\Foxminded\AbstractFactory\contracts\Dish;
use Kata\Foxminded\AbstractFactory\contracts\LunchFactory;

class ItalianLunchFactory implements LunchFactory
{
    public function createDish(): Dish
    {
        return new Spagetti();
    }

    public function createDesert(): Dessert
    {
        return new Tiramisu();
    }
}
