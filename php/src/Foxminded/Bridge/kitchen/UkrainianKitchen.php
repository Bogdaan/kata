<?php
declare(strict_types=1);

namespace Kata\Foxminded\Bridge\kitchen;

use Kata\Foxminded\Bridge\dishes\DishInterface;

class UkrainianKitchen implements KitchenInterface
{
    /**
     * @var DishInterface
     */
    private $dish;

    public function __construct(DishInterface $dish)
    {
        $this->dish = $dish;
    }

    public function cook(): void
    {
        echo "UkrainianKitchen!\n";
        $this->dish->heatUp();
    }
}
