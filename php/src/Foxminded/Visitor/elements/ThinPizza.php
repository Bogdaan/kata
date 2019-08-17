<?php
declare(strict_types=1);

namespace Kata\Foxminded\Visitor\elements;

use Kata\Foxminded\Visitor\visitors\VisitorInterface;

class ThinPizza implements PizzaInterface
{
    public function accept(VisitorInterface $visitor): void
    {
        $visitor->visitThin($this);
    }

    public function changeShape(string $string)
    {

    }
}
