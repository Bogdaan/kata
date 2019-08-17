<?php
declare(strict_types=1);

namespace Kata\Foxminded\State\internal;

class Oven implements OvenStateInterface
{
    /**
     * @var OvenStateInterface
     */
    private $state;

    public function __construct()
    {
        $this->state = new ColdState();
    }

    public function bake(): void
    {
        $this->state->bake();
    }
}
