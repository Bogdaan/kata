<?php
declare(strict_types=1);

namespace Kata\DiagramExtractor\internal\formatter;

use Kata\DiagramExtractor\internal\valueObjects\Group;
use Kata\DiagramExtractor\internal\FormatterInterface;
use Kata\DiagramExtractor\internal\valueObjects\UseCase;
use SimpleXMLElement;

class DrawIoXmlFormatter implements FormatterInterface
{
    private const MX_CELL = 'mxCell';
    private const MX_GEOMETRY = 'mxGeometry';

    private const USE_CASE_WIDTH = 200;
    private const USE_CASE_HEIGHT = 70;
    private const USE_CASE_OFFSET = 10;

    private const ROOT_GROUP_WITH = 200;
    private const ROOT_GROUP_HEIGHT = 200;

    /**
     * @var SimpleXMLElement
     */
    private $layout;

    /**
     * @var SimpleXMLElement
     */
    private $rootElement;

    public function __construct()
    {
        $layout = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<mxfile version="11.1.2" type="google" compressed="false">
  <diagram id="use-case" name="use-case diagram">
    <mxGraphModel dx="0" dy="0" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" 
        pageScale="1" pageWidth="1000" pageHeight="1000" math="0" shadow="0">
      <root></root>
    </mxGraphModel>
  </diagram>
</mxfile>
XML;

        $this->layout = simplexml_load_string($layout);
        $nodes = $this->layout->xpath('//root');
        $this->rootElement = reset($nodes);
    }


    public function format(Group $group): string
    {
        $this->addRootGroup($group);
        $this->addUseCases($group);

        return $this->layout->asXML();
    }

    private function addRootGroup(Group $group): void
    {
        $newNode = $this->addChild(
            $this->rootElement,
            self::MX_CELL,
            [
                'id' => 'root-id',
                'value' => $group->getName(),
                'style' => 'swimlane;',
                'parent' => '1',
                'vertex' => '1',
            ]
        );
        $this->addChild(
            $newNode,
            self::MX_GEOMETRY,
            [
                'x' => '0',
                'y' => '0',
                'width' => self::ROOT_GROUP_WITH,
                'height' => self::ROOT_GROUP_HEIGHT,
                'as' => 'geometry',
            ]
        );
    }

    private function addUseCases(Group $group): void
    {
        foreach ($group->getUseCases() as $index => $useCase) {
            $this->addUseCase($index, $useCase);
        }
    }

    private function addUseCase(int $index, UseCase $useCase): void
    {
        $newNode = $this->addChild(
            $this->rootElement,
            static::MX_CELL,
            [
                'value' => $useCase->getName(),
                'style' => $this->getStyle($useCase),
                'parent' => 'root-id',
                'vertex' => '1',
            ]
        );
        $this->addChild(
            $newNode,
            static::MX_GEOMETRY,
            [
                'x' => self::USE_CASE_OFFSET + $index * (self::USE_CASE_OFFSET + self::USE_CASE_WIDTH),
                'y' => '1',
                'width' => self::USE_CASE_WIDTH,
                'height' => self::USE_CASE_HEIGHT,
                'as' => 'geometry',
            ]
        );
    }

    private function getStyle(UseCase $useCase): string
    {
        $style = 'ellipse;whiteSpace=wrap;html=1;';
        switch ($useCase->getCqrs()) {
            case UseCase::COMMAND:
                return $style . 'fillColor=#dae8fc;strokeColor=#6c8ebf;';
            case UseCase::QUERY:
                return $style . 'fillColor=#fff2cc;strokeColor=#d6b656;';
            case UseCase::REQUEST:
                return $style . 'fillColor=#f5f5f5;strokeColor=#666666;';
            default:
                return $style;
        }
    }

    private function addChild(SimpleXMLElement $root, string $tagName, array $attributes): SimpleXMLElement
    {
        $node = $root->addChild($tagName, null);
        foreach ($attributes as $name => $value) {
            $node->addAttribute($name, (string)$value);
        }

        return $node;
    }
}
