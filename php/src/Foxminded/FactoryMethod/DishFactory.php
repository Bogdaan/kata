<?php
declare(strict_types=1);

namespace Kata\Foxminded\FactoryMethod;

use InvalidArgumentException;
use Kata\Foxminded\FactoryMethod\valueObjects\Dish;
use Kata\Foxminded\FactoryMethod\valueObjects\Borscht;
use Kata\Foxminded\FactoryMethod\valueObjects\Spagetti;

class DishFactory
{
    public const UA = 'ua';
    public const IT = 'it';

    public function create(string $locale): Dish
    {
        switch ($locale) {
            case static::UA:
                return new Borscht();
            case static::IT:
                return new Spagetti();
        }

        throw new InvalidArgumentException(sprintf("Invalid type: %s", $locale));
    }
}
