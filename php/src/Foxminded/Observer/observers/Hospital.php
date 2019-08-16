<?php
declare(strict_types=1);

namespace Kata\Foxminded\Observer\observers;

class Hospital implements ObserverInterface
{
    public function stormWarning(): void
    {
        echo "Hospital notified\n";
    }
}
