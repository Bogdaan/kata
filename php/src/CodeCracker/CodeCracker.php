<?php
declare(strict_types=1);

namespace Kata\CodeCracker;

class CodeCracker
{
    /**
     * @var
     */
    private $decryptionMap;

    public function __construct(string $alphabet, string $decryptionKey)
    {
        $this->decryptionMap = array_combine(
            str_split($decryptionKey),
            str_split($alphabet)
        );
    }

    public function crack(string $message): string
    {
        return strtr($message, $this->decryptionMap);
    }
}
