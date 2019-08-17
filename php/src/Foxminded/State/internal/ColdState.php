<?php
declare(strict_types=1);

namespace Kata\Foxminded\State\internal;

use DomainException;

class ColdState implements OvenStateInterface
{
    public function bake(): void
    {
        throw new DomainException("Youy need to heat up oven");
    }
}
