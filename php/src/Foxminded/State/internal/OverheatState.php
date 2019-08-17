<?php
declare(strict_types=1);

namespace Kata\Foxminded\State\internal;

use DomainException;

class OverheatState implements OvenStateInterface
{
    public function bake(): void
    {
        throw new DomainException("You need to cool down oven");
    }
}
