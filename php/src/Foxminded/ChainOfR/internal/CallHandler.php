<?php
declare(strict_types=1);

namespace Kata\Foxminded\ChainOfR\internal;

interface CallHandler
{
    public function handle(string $number): void;
}
