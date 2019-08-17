<?php
declare(strict_types=1);

namespace Kata\Foxminded\Visitor\elements;

use Kata\Foxminded\Visitor\visitors\VisitorInterface;

interface PizzaInterface
{
    public function accept(VisitorInterface $visitor): void;
}
