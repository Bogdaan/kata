<?php

interface Command
{
    public function execute(): void;
}

class NameCommand implements Command
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function execute(): void
    {
        echo "hi " . $this->name . "\n";
    }
}

class TestCommand implements Command
{
    public function execute(): void
    {
        echo "test\n";
    }
}

switch($_GET['command'] ?? '') {
    case "name":
        (new NameCommand("Bogdan"))->execute();
        break;
    case "test":
        (new TestCommand())->execute();
        break;
    default:
        echo "page not found\n";
}
