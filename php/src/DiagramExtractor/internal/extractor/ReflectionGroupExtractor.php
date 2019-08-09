<?php
declare(strict_types=1);

namespace Kata\DiagramExtractor\internal\extractor;

use Kata\DiagramExtractor\internal\GroupExtractorInterface;
use Kata\DiagramExtractor\internal\valueObjects\Group;
use Kata\DiagramExtractor\internal\valueObjects\UseCase;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

class ReflectionGroupExtractor implements GroupExtractorInterface
{
    /**
     * @param string $className
     * @return UseCase
     * @throws ReflectionException
     */
    public function extract(string $className): Group
    {
        $reflection = new ReflectionClass($className);

        $group = new Group($reflection->getName(), []);
        foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            $useCase = $this->extractFrom($method->getDocComment());
            if (empty($useCase)) {
                continue;
            }
            $group->add($useCase);
        }

        return $group;
    }

    private function extractFrom(string $phpDoc): ?UseCase
    {
        $totalMatches = preg_match_all('/^\s+[\*\/ ]+(.*)/m', $phpDoc, $matches, PREG_SET_ORDER);
        if (empty($totalMatches)) {
            return null;
        }

        $lastMatchIndex = $totalMatches - 1;
        $lastNewlineIndex = 0;
        $lines = [];
        foreach ($matches as $index => $match) {
            if (empty($match[1]) && $index != $lastMatchIndex) {
                $lastNewlineIndex = $index;
            }
            $lines[] = $match[1];
        }

        $name = trim(implode("\n", array_slice($lines, $lastNewlineIndex)), "\n");

        return new UseCase($name);
    }
}
