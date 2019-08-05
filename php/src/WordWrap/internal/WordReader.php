<?php
declare(strict_types=1);

namespace Kata\WordWrap\internal;

class WordReader
{
    /**
     * @var string
     */
    private $source;

    /**
     * @var int
     */
    private $sourceLength;

    /**
     * @var int
     */
    private $currentPosition;

    public function __construct(string $source)
    {
        $this->source = $source;
        $this->sourceLength = strlen($source);
        $this->currentPosition = 0;
    }

    public function read(): Word
    {
        $spacePosition = strpos($this->source, ' ', $this->currentPosition + 1);
        if ($spacePosition === false) {
            $text = substr($this->source, $this->currentPosition);
        } else {
            $text = substr($this->source, $this->currentPosition, $spacePosition - $this->currentPosition);
        }
        $this->currentPosition += strlen($text);

        return new Word($text);
    }

    public function isNotEnd(): bool
    {
        return $this->currentPosition < $this->sourceLength;
    }
}
