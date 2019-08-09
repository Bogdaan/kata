<?php
declare(strict_types=1);

namespace Kata\DiagramExtractor\internal;

use Kata\DiagramExtractor\internal\valueObjects\Group;

interface GroupExtractorInterface
{
    public function extract(string $className): Group;
}
