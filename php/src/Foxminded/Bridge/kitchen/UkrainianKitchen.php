<?php
declare(strict_types=1);

namespace Kata\Foxminded\Bridge\kitchen;

class UkrainianKitchen extends AbstractKitchen
{
    public function cook(): void
    {
        echo "UkrainianKitchen!\n";
        $this->dish->heatUp();
    }
}
