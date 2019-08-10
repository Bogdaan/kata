<?php
declare(strict_types=1);

namespace Kata\Foxminded\AbstractFactory\ua;

use Kata\Foxminded\AbstractFactory\contracts\Dessert;
use Kata\Foxminded\AbstractFactory\contracts\Dish;
use Kata\Foxminded\AbstractFactory\contracts\LunchFactory;

class UkrainianLunchFactory implements LunchFactory
{
    public function createDish(): Dish
    {
        return new Borscht();
    }

    public function createDesert(): Dessert
    {
        return new Pelmeni();
    }
}
