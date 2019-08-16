<?php
declare(strict_types=1);

namespace Kata\Foxminded\Observer\observers;

interface ObserverInterface
{
    public function stormWarning(): void;
}
