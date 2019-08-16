<?php
declare(strict_types=1);

namespace Kata\Foxminded\Interpreter;

use Kata\Foxminded\Interpreter\internal\AbstractExpression;
use Kata\Foxminded\Interpreter\internal\AddCheeseExpression;
use Kata\Foxminded\Interpreter\internal\Pizza;
use Kata\Foxminded\Interpreter\internal\PlaceToOwenExpression;

class Interpreter
{
    /**
     * @var AbstractExpression[]
     */
    private $dsl;

    public function __construct()
    {
        $this->dsl = [
            'add-cheese' => new AddCheeseExpression(),
            'put-to-owen' => new PlaceToOwenExpression(),
        ];
    }

    public function interpret(string $expression): void
    {
        $pizza = new Pizza();

        $lexems = explode(' ', $expression);
        foreach ($lexems as $lexem) {
            if (empty($this->dsl[$lexem])) {
                continue;
            }
            $this->dsl[$lexem]->execute($pizza);
        }
    }
}
