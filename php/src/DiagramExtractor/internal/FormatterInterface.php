<?php
declare(strict_types=1);

namespace Kata\DiagramExtractor\internal;

use Kata\DiagramExtractor\internal\valueObjects\Group;

interface FormatterInterface
{
    public function format(Group $group): string;
}
