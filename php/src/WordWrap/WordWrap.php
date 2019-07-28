<?php
declare(strict_types=1);

namespace Kata\WordWrap;

class WordWrap
{
    public function wrap(string $input, int $limit): string
    {
        $inputLength = strlen($input);
        $lineStartPosition = 0;
        $lines = [];

        while ($lineStartPosition < $inputLength) {
            $nextLineStartPosition = $lineStartPosition + $limit;

            $charBeforeStart = substr($input, $nextLineStartPosition - 1, 1);
            $charAtStart = substr($input, $nextLineStartPosition, 1);
            $charAfterStart = substr($input, $nextLineStartPosition + 1, 1);

            if ($charBeforeStart !== false
                && $charBeforeStart !== ' '
                && $charAtStart !== ' '
                && $charAfterStart !== false
                && $charAfterStart !== ' '
            ) {
                // found some words in current line?
                // yes: decrement to last space
                // no: break the line
                $spacePosition = strrpos($input, ' ', -$nextLineStartPosition);
                if ($spacePosition !== false && $nextLineStartPosition - $spacePosition < $limit) {
                    $nextLineStartPosition = $spacePosition + 1;
                }
            }

            $line = substr($input, $lineStartPosition, $nextLineStartPosition - $lineStartPosition);
            $lines[] = trim($line, ' ');
            $lineStartPosition = $nextLineStartPosition;
        }

        return implode(PHP_EOL, $lines);
    }
}
