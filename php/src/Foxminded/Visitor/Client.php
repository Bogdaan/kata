<?php
declare(strict_types=1);

namespace Kata\Foxminded\Visitor;

use Kata\Foxminded\Visitor\elements\FatPizza;
use Kata\Foxminded\Visitor\elements\ThinPizza;
use Kata\Foxminded\Visitor\visitors\BaconVisitor;
use Kata\Foxminded\Visitor\visitors\CheeseVisitor;

class Client
{
    public function main()
    {
        $cheese = new CheeseVisitor();
        $bacon = new BaconVisitor();

        $thinPizza = new ThinPizza();
        $thinPizza->accept($cheese);
        $thinPizza->accept($bacon);

        $fatPizza = new FatPizza();
        $fatPizza->accept($cheese);
        $fatPizza->accept($bacon);
    }
}
