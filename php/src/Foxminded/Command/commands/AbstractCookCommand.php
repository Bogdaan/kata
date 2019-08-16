<?php
declare(strict_types=1);

namespace Kata\Foxminded\Command\commands;

use Kata\Foxminded\Command\internal\Dough;

abstract class AbstractCookCommand implements CommandInterface
{
    /**
     * @var Dough
     */
    private $dough;

    public function __construct(Dough $dough)
    {
        $this->dough = $dough;
    }
}
