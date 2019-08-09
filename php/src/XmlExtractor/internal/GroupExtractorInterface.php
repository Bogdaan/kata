<?php
declare(strict_types=1);

namespace Kata\XmlExtractor\internal;

use Kata\XmlExtractor\internal\valueObjects\Group;

interface GroupExtractorInterface
{
    public function extract(string $className): Group;
}
