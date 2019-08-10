<?php
declare(strict_types=1);

namespace Kata\Foxminded\Builder;

use Kata\Foxminded\Builder\internal\Pizza;
use Kata\Foxminded\Builder\internal\SpicyPizzaBuilder;

class Client
{
    public function main()
    {
        $pizza = new Pizza(new SpicyPizzaBuilder());
        $pizza->cook();
    }
}
