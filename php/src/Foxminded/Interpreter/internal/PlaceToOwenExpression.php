<?php
declare(strict_types=1);

namespace Kata\Foxminded\Interpreter\internal;

class PlaceToOwenExpression extends AbstractExpression
{
    public function execute(Pizza $context): void
    {
        echo "to owen!\n";
    }
}
