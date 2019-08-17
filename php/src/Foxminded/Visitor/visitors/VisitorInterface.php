<?php
declare(strict_types=1);

namespace Kata\Foxminded\Visitor\visitors;

use Kata\Foxminded\Visitor\elements\FatPizza;
use Kata\Foxminded\Visitor\elements\ThinPizza;

interface VisitorInterface
{
    public function visitFat(FatPizza $pizza): void;

    public function visitThin(ThinPizza $pizza): void;
}
