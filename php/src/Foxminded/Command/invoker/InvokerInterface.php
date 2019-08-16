<?php
declare(strict_types=1);

namespace Kata\Foxminded\Command\invoker;

interface InvokerInterface
{
    public function make(): void;
}
