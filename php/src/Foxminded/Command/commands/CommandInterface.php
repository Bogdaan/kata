<?php
declare(strict_types=1);

namespace Kata\Foxminded\Command\commands;

interface CommandInterface
{
    public function execute(): void;
}
