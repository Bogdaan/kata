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
        $this->createRoot($group);
        $this->createUseCases($group);

        return $this->layout->asXML();
    }

    private function createRoot(Group $group): void
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
                'width' => '200',
                'height' => '200',
                'as' => 'geometry',
            ]
        );
    }

    private function createUseCases(Group $group): void
    {
        foreach ($group->getUseCases() as $useCase) {
            $this->createUseCase($useCase);
        }
    }

    private function createUseCase(UseCase $useCase): void
    {
        $newNode = $this->addChild(
            $this->rootElement,
            static::MX_CELL,
            [
                'value' => $useCase->getName(),
                'style' => 'ellipse;whiteSpace=wrap;html=1;',
                'parent' => 'root-id',
                'vertex' => '1',
            ]
        );
        $this->addChild(
            $newNode,
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

    private function addChild(SimpleXMLElement $root, string $tagName, array $attributes): SimpleXMLElement
    {
        $node = $root->addChild($tagName, null);
        foreach ($attributes as $name => $value) {
            $node->addAttribute($name, $value);
        }

        return $node;
    }
}
