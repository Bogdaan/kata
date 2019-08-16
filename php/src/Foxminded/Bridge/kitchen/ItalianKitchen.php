<?php
declare(strict_types=1);

namespace Kata\Foxminded\Bridge\kitchen;

use Kata\Foxminded\Bridge\dishes\DishInterface;

class ItalianKitchen implements KitchenInterface
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
        echo "ItalianKitchen!\n";
        $this->dish->heatUp();
    }
}
