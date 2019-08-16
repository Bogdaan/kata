<?php
declare(strict_types=1);

namespace Kata\Foxminded\Memento\internal;

class Memento
{
    /**
     * @var string
     */
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
