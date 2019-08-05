<?php
declare(strict_types=1);

namespace Kata\WordWrap;

use Kata\WordWrap\internal\WordReader;
use Kata\WordWrap\internal\LimitedLineWriter;

class WordWrap
{
    public function wrap(string $input, int $limit): string
    {
        $reader = new WordReader($input);
        $writer = new LimitedLineWriter($limit);

        while ($reader->isNotEnd()) {
            $writer->write($reader->read());
        };

        return $writer->toString();

//        $inputLength = strlen($input);
//        $lines = [];
//
//        $lineStart = 0;
//        while ($lineStart < $inputLength) {
//            $line = substr($input, $lineStart, $limit);
//            if ($this->startsWithSpace($line)) {
//                $lineStart++;
//                continue;
//            }
//
//            $nextLineStart = $lineStart + strlen($line);
//
//            $lastSpacePositionInsideLine = strrpos($line, ' ');
//            if ($lastSpacePositionInsideLine !== false) {
//                $boundaryWordStart = $lineStart + $lastSpacePositionInsideLine + 1;
//
//                $boundaryWordEnd = strpos($input, ' ', $boundaryWordStart);
//                if ($boundaryWordEnd === false) {
//                    $boundaryWordEnd = $inputLength;
//                }
//
//                // move boundary word to new line
//                if ($boundaryWordEnd > $nextLineStart && $boundaryWordEnd - $boundaryWordStart <= $limit) {
//                    $line = substr($input, $lineStart, $boundaryWordStart - $lineStart);
//                    $nextLineStart = $lineStart + strlen($line);
//                }
//            }
//
//            $lines[] = trim($line);
//            $lineStart = $nextLineStart;
//        }
//
//        return implode(PHP_EOL, $lines);
    }

    private function startsWithSpace($line): bool
    {
        return substr($line, 0, 1) === ' ';
    }
}
