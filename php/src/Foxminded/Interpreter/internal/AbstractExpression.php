<?php
declare(strict_types=1);

namespace Kata\Foxminded\Interpreter\internal;

abstract class AbstractExpression
{
    abstract public function execute(Pizza $context): void;
}
