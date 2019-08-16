<?php
declare(strict_types=1);

namespace Kata\Foxminded\Memento\internal;

class Editor
{
    /**
     * @var string
     */
    private $text;

    public function change(string $text): void
    {
        $this->text = $text;
    }

    public function createMemento(): Memento
    {
        return new Memento($this->text);
    }

    public function setMemento(Memento $memento): void
    {
        $this->text = $memento->getText();
    }
}
