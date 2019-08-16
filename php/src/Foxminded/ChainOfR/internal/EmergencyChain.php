<?php
declare(strict_types=1);

namespace Kata\Foxminded\ChainOfR\internal;

class EmergencyChain implements CallHandler
{
    public function handle(string $number): void
    {
        /** @var CallHandler[] $handlers */
        $handlers = [
            new FirefightersHandler(),
            new AmbulanceHandler(),
            new PoliceHandler(),
        ];
        foreach ($handlers as $handler) {
            $handler->handle($number);
        }
    }
}
