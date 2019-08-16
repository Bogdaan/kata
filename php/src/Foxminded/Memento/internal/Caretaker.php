<?php
declare(strict_types=1);

namespace Kata\Foxminded\Memento\internal;

class Caretaker
{
    /**
     * @var Memento[]
     */
    private $states;

    public function add(Memento $memento): void
    {
        $this->states[] = $memento;
    }

    public function restore(int $version): ?Memento
    {
        return $this->states[$version] ?? null;
    }
}
