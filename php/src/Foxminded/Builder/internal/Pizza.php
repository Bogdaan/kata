<?php
declare(strict_types=1);

namespace Kata\Foxminded\Builder\internal;

class Pizza
{
    private $cheese;

    private $paper;

    private $vegetables;

    public function __construct(PizzaBuilder $builder)
    {
        $this->cheese = $builder->getCheese();
        $this->paper = $builder->getPaper();
        $this->vegetables = $builder->getVegetables();
    }

    public function cook(): Pizza
    {
        return $this;
    }
}
