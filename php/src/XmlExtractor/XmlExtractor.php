<?php
declare(strict_types=1);

namespace Kata\XmlExtractor;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use SimpleXMLElement;

class XmlExtractor
{
    const MX_CELL = 'mxCell';
    const MX_GEOMETRY = 'mxGeometry';

    /**
     * @var SimpleXMLElement
     */
    private $layout;

    /**
     * @var SimpleXMLElement
     */
    private $rootElement;

    public function __construct(string $layout)
    {
        $layout = simplexml_load_string($layout);
        if ($layout === false) {
            throw new InvalidArgumentException("Invalid layout");
        }
        $nodes = $layout->xpath('//root');
        if (empty($nodes)) {
            throw new InvalidArgumentException("Root node not found");
        }

        $this->layout = $layout;
        $this->rootElement = reset($nodes);
    }

    /**
     * @param string $className
     * @return string
     * @throws ReflectionException
     */
    public function extract(string $className): string
    {
        $reflection = new ReflectionClass($className);

        $this->addRoot($reflection->getName());
        $this->addMethods($reflection);

        return $this->layout->asXML();
    }

    private function addRoot(string $className): void
    {
        $classNode = $this->addXmlNode(
            $this->rootElement,
            self::MX_CELL,
            [
                'id' => 'root-id',
                'value' => $className,
                'style' => 'swimlane;',
                'parent' => '1',
                'vertex' => '1',
            ]
        );
        $this->addXmlNode(
            $classNode,
            self::MX_GEOMETRY,
            [
                'x' => '0',
                'y' => '0',
                'width' => '200',
                'height' => '200',
                'as' => 'geometry',
            ]
        );
    }

    private function addMethods(ReflectionClass $reflection): void
    {
        foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            $useCase = $this->extractUseCase($method->getDocComment());
            if (empty($useCase)) {
                continue;
            }
            $this->addUseCase($useCase);
        }
    }

    private function addUseCase(string $comment): void
    {
        $commentNode = $this->addXmlNode(
            $this->rootElement,
            static::MX_CELL,
            [
                'value' => $comment,
                'style' => 'ellipse;whiteSpace=wrap;html=1;',
                'parent' => 'root-id',
                'vertex' => '1',
            ]
        );
        $this->addXmlNode(
            $commentNode,
            static::MX_GEOMETRY,
            [
                'x' => '1',
                'y' => '1',
                'width' => '200',
                'height' => '70',
                'as' => 'geometry',
            ]
        );
    }

    private function addXmlNode(SimpleXMLElement $root, string $tagName, array $attributes): SimpleXMLElement
    {
        $node = $root->addChild($tagName, null);
        foreach ($attributes as $name => $value) {
            $node->addAttribute($name, $value);
        }

        return $node;
    }

    private function extractUseCase(string $phpComment): string
    {
        $totalMatches = preg_match_all('/^\s+[\*\/ ]+(.*)/m', $phpComment, $matches, PREG_SET_ORDER);
        if (empty($totalMatches)) {
            return '';
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

        return trim(implode("\n", array_slice($lines, $lastNewlineIndex)), "\n");
    }
}
