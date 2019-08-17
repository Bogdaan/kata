<?php
declare(strict_types=1);

namespace Kata\Foxminded\Strategy;

use Kata\Foxminded\Strategy\internal\Collection;

class Client
{
    public function main()
    {
        $collection = new Collection();
        $collection->sort(Collection::QUICK_SORT);
    }
}
