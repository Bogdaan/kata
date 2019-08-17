<?php
declare(strict_types=1);

namespace Kata\Foxminded\State\internal;

class ReadyState implements OvenStateInterface
{
    public function bake(): void
    {
        echo "Complate \n";
    }
}
