<?php
declare(strict_types=1);

namespace Kata\Foxminded\Command;

use Kata\Foxminded\Command\commands\AddCheese;
use Kata\Foxminded\Command\commands\PlaceToOwen;
use Kata\Foxminded\Command\internal\Dough;
use Kata\Foxminded\Command\invoker\Pizza;

class Client
{
    public function main()
    {
        $dough = new Dough();

        $pizza = new Pizza();
        $pizza->add(new AddCheese($dough));
        $pizza->add(new PlaceToOwen($dough));
        $pizza->make();
    }
}
