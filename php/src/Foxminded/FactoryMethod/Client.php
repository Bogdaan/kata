<?php
declare(strict_types=1);

namespace Kata\Foxminded\FactoryMethod;

class Client
{
    function main()
    {
        $factory = new DishFactory();
        $factory->create(DishFactory::UA);
    }
}
