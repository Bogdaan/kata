<?php
declare(strict_types=1);

namespace Kata\Foxminded\Bridge\kitchen;

use Kata\Foxminded\Bridge\dishes\DishInterface;

abstract class AbstractKitchen implements KitchenInterface
{
    /**
     * @var DishInterface
     */
    protected $dish;

    public function __construct(DishInterface $dish)
    {
        $this->dish = $dish;
    }

    abstract public function cook(): void;
}
