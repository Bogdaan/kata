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
            $phpDoc = $method->getDocComment();
            if (empty($phpDoc)) {
                continue;
            }
            $useCase = $this->extractFrom($phpDoc);
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
        $cqrs = '';

        foreach ($matches as $index => $match) {
            $clearLine = $match[1];
            if (empty($clearLine) && $index != $lastMatchIndex) {
                $lastNewlineIndex = $index;
            }
            $lines[] = $clearLine;
            if (substr($clearLine, 0, 6) === 'cqrs: ') {
                $cqrs = substr($clearLine, 6);
            }
        }

        $name = trim(implode("\n", array_slice($lines, $lastNewlineIndex)), "\n");

        return new UseCase($name, $cqrs);
    }
}
