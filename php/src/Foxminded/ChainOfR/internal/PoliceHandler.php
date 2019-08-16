<?php
declare(strict_types=1);

namespace Kata\Foxminded\ChainOfR\internal;

class PoliceHandler implements CallHandler
{
    public function handle(string $number): void
    {
        if ($number === '911') {
            echo "Police - we go\n";
        }
    }
}
