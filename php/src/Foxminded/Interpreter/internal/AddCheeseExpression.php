<?php
declare(strict_types=1);

namespace Kata\Foxminded\Interpreter\internal;

class AddCheeseExpression extends AbstractExpression
{
    public function execute(Pizza $context): void
    {
        echo "cheese added\n";
    }
}
