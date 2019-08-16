<?php
declare(strict_types=1);

namespace Kata\Foxminded\Command\invoker;

use Kata\Foxminded\Command\commands\CommandInterface;

class Pizza implements InvokerInterface
{
    /**
     * @var CommandInterface[]
     */
    private $commands;

    public function add(CommandInterface $command): void
    {
        $this->commands[] = $command;
    }

    public function make(): void
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }
}
