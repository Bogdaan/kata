<?php
declare(strict_types=1);

class WordWrap
{
    public function wrap(int $limit, string $input): string
    {
        $words = explode(' ', $input);
        $output = '';

        $output .= $this->addWord($limit, array_shift($words));
        foreach ($words as $index => $word) {
            if (strlen($word) + 1 + strlen($output) < $limit) {
                $output .= ' ' . $word;
            } else {
                $output .= PHP_EOL . $word;
            }
        }

        return $output;
    }

    private function addWord(int $limit, string $word): string
    {
        $chunks = str_split($word, $limit);

        return implode(PHP_EOL, $chunks);
    }
}
