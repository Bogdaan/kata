<?php
declare(strict_types=1);

namespace Kata\Foxminded\Strategy\internal;

class Collection
{
    public const QUICK_SORT = 1;
    public const BUBLE_SORT = 2;

    /**
     * @var array
     */
    private $data = [];

    public function sort(int $sortType): array
    {
        if ($sortType === static::QUICK_SORT) {
            return (new QuickSortStrategy())->sort($this->data);
        } else {
            return (new BubleSortStrategy())->sort($this->data);
        }
    }
}
