<?php
declare(strict_types=1);

namespace Kata\Foxminded\Strategy\internal;

interface SortStrategyInterface
{
    public function sort(array $data): array;
}
