<?php
declare(strict_types=1);

namespace Kata\Foxminded\Memento;

use Kata\Foxminded\Memento\internal\Caretaker;
use Kata\Foxminded\Memento\internal\Editor;

class Client
{
    public function main()
    {
        $editor = new Editor();
        $caretaker = new Caretaker();

        $editor->change('first text!');
        $caretaker->add($editor->createMemento());

        $editor->change('other');
        $caretaker->add($editor->createMemento());

        $editor->setMemento(
            $caretaker->restore(1)
        );
    }
}
