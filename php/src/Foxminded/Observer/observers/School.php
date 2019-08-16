<?php
declare(strict_types=1);

namespace Kata\Foxminded\Observer\observers;

class School implements ObserverInterface
{
    public function stormWarning(): void
    {
        echo "School notified\n";
    }
}
