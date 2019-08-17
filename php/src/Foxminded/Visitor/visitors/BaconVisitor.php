<?php
declare(strict_types=1);

namespace Kata\Foxminded\Visitor\visitors;

use Kata\Foxminded\Visitor\elements\FatPizza;
use Kata\Foxminded\Visitor\elements\ThinPizza;

class BaconVisitor implements VisitorInterface
{
    public function visitFat(FatPizza $pizza): void
    {
        $pizza->changeIngridients('test');
    }

    public function visitThin(ThinPizza $pizza): void
    {
        $pizza->changeShape('Y');
    }
}
