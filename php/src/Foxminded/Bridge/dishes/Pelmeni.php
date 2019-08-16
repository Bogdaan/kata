<?php
declare(strict_types=1);

namespace Kata\Foxminded\Bridge\dishes;

class Pelmeni implements DishInterface
{
    public function heatUp(): void
    {
        echo "heatUp\n";
    }
}
