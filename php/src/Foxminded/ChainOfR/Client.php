<?php
declare(strict_types=1);

namespace Kata\Foxminded\ChainOfR;

use Kata\Foxminded\ChainOfR\internal\EmergencyChain;

class Client
{
    public function main()
    {
        $chain = new EmergencyChain();
        $chain->handle('911');
    }
}
