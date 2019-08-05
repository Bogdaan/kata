<?php
declare(strict_types=1);

namespace Kata\WordWrap\internal;

class Word
{
    /**
     * @var string
     */
    private $text;

    public function __construct(string $text)
    {
        $this->text = trim($text);
    }

    public static function emptyObject(): Word
    {
        return new static('');
    }

    public function length(): int
    {
        return strlen($this->text);
    }

    public function isNotEmpty(): bool
    {
        return $this->length() !== 0;
    }

    public function substr(int $start, int $length = null): Word
    {
        if ($length === null) {
            return new Word(substr($this->text, $start));
        } else {
            return new Word(substr($this->text, $start, $length));
        }
    }

    public function toString()
    {
        return $this->text;
    }
}
