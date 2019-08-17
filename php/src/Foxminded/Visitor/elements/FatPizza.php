<?php
declare(strict_types=1);

namespace Kata\Foxminded\Visitor\elements;

use Kata\Foxminded\Visitor\visitors\VisitorInterface;

class FatPizza implements PizzaInterface
{
    public function accept(VisitorInterface $visitor): void
    {
        $visitor->visitFat($this);
    }

    public function changeIngridients(string $data): void
    {

    }
}
