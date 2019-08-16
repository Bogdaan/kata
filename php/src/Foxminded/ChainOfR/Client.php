<?php
declare(strict_types=1);

namespace Kata\Foxminded\ChainOfR;

use Kata\Foxminded\ChainOfR\internal\AmbulanceHandler;
use Kata\Foxminded\ChainOfR\internal\CallHandler;
use Kata\Foxminded\ChainOfR\internal\FirefightersHandler;
use Kata\Foxminded\ChainOfR\internal\PoliceHandler;

class Client
{
    public function main()
    {
        $number = '911';

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
