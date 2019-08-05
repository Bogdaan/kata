<?php
declare(strict_types=1);

namespace Kata\WordWrap\internal;

class Line
{
    /**
     * @var Word[]
     */
    private $words;

    /**
     * @var int
     */
    private $lengthLimit;

    /**
     * @var int
     */
    private $wordsLength;

    /**
     * @var bool
     */
    private $isComplete;

    public function __construct(int $lengthLimit)
    {
        $this->lengthLimit = $lengthLimit;
        $this->words = [];
        $this->wordsLength = 0;
        $this->isComplete = false;
    }

    public function place(Word $word): Word
    {
        $spaceLeft = $this->spaceLeft($word);

        if ($spaceLeft >= 0) {
            $this->addWord($word);

            return Word::emptyObject();
        } elseif ($word->length() > $this->lengthLimit) {
            $this->isComplete = true;
            $breakPosition = $word->length() + $spaceLeft;
            $this->addWord(
                $word->substr(0, $breakPosition)
            );

            // break word into parts
            return $word->substr($breakPosition);
        } else {
            $this->isComplete = true;

            // word fits in new line - move it to new line
            return $word;
        }
    }

    public function isCompete(): bool
    {
        return $this->isComplete;
    }

    public function toString(): string
    {
        return implode(' ', $this->wordsAsArray());
    }

    private function spaceLeft(Word $word): int
    {
        return $this->lengthLimit - $this->lengthWithSpaces() - $word->length();
    }

    private function addWord(Word $word): void
    {
        $this->words[] = $word;
        $this->wordsLength += $word->length();
    }

    private function wordsAsArray(): array
    {
        return array_map(
            function (Word $word) {
                return $word->toString();
            },
            $this->words
        );
    }

    private function lengthWithSpaces(): int
    {
        return $this->wordsLength + count($this->words);
    }
}
