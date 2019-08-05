<?php
declare(strict_types=1);

namespace Kata\WordWrap\internal;

class LimitedLineWriter
{
    /**
     * @var array
     */
    private $lines;

    /**
     * @var int
     */
    private $lineLengthLimit;

    public function __construct(int $lineLengthLimit)
    {
        $this->lineLengthLimit = $lineLengthLimit;
        $this->lines = [];
    }

    public function write(Word $word): void
    {
        while ($word->isNotEmpty()) {
            $word = $this->lastIncomplateLine()->place($word);
        }
    }

    public function toString(): string
    {
        return implode(
            PHP_EOL,
            array_map(
                function (Line $line) {
                    return $line->toString();
                },
                $this->lines
            )
        );
    }

    private function lastIncomplateLine(): Line
    {
        /** @var Line $line */
        $line = end($this->lines);
        if ($line === false || $line->isCompete()) {
            $line = new Line($this->lineLengthLimit);
            $this->lines[] = $line;
        }

        return $line;
    }
}
