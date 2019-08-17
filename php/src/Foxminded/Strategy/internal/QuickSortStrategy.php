<?php
declare(strict_types=1);

namespace Kata\Foxminded\Strategy\internal;

class QuickSortStrategy implements SortStrategyInterface
{
    public function sort(array $data): array
    {
        return $data;
    }
}
