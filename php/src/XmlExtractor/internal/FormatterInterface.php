<?php
declare(strict_types=1);

namespace Kata\XmlExtractor\internal;

use Kata\XmlExtractor\internal\valueObjects\Group;

interface FormatterInterface
{
    public function format(Group $group): string;
}
