<?php
declare(strict_types=1);

namespace Kata\Foxminded\Bridge\kitchen;

class ItalianKitchen extends AbstractKitchen
{
    public function cook(): void
    {
        echo "ItalianKitchen!\n";
        $this->dish->heatUp();
    }
}
