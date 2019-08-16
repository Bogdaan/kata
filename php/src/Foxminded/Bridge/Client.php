<?php
declare(strict_types=1);

namespace Kata\Foxminded\Bridge;

use Kata\Foxminded\Bridge\dishes\Borscht;
use Kata\Foxminded\Bridge\dishes\Pelmeni;
use Kata\Foxminded\Bridge\kitchen\ItalianKitchen;
use Kata\Foxminded\Bridge\kitchen\UkrainianKitchen;

class Client
{
    public function main()
    {
        $uaBorscht = new UkrainianKitchen(new Borscht());
        $uaBorscht->cook();

        $uaPelmeni = new ItalianKitchen(new Pelmeni());
        $uaPelmeni->cook();
    }
}
