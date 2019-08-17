<?php
declare(strict_types=1);

namespace Kata\Foxminded\State;

use Kata\Foxminded\State\internal\Oven;

class Client
{
    public function main()
    {
        $oven = new Oven();
        $oven->bake();
    }
}
