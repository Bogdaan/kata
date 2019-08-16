<?php
declare(strict_types=1);

namespace Kata\Foxminded\Command\commands;

class AddCheese extends AbstractCookCommand
{
    public function execute(): void
    {
        echo "cheese added\n";
    }
}
