<?php
declare(strict_types=1);

namespace Kata\DiagramExtractor;

use Kata\DiagramExtractor\internal\extractor\ReflectionGroupExtractor;
use Kata\DiagramExtractor\internal\formatter\DrawIoXmlFormatter;
use Kata\DiagramExtractor\samples\CommandMethod;
use Kata\DiagramExtractor\samples\EmptyClass;
use Kata\DiagramExtractor\samples\MultipleMethods;
use Kata\DiagramExtractor\samples\QueryMethod;
use Kata\DiagramExtractor\samples\SingleMethod;
use PHPUnit\Framework\TestCase;

class DrawIoDiagramExtractorTest extends TestCase
{
    /**
     * @var DiagramExtractor
     */
    private $drawIoExtractor;

    protected function setUp()
    {
        $this->drawIoExtractor = new DiagramExtractor(new ReflectionGroupExtractor(), new DrawIoXmlFormatter());
    }

    public function testExtractFromClassWithoutMethods(): void
    {
        $sourceClass = EmptyClass::class;
        $xpath = [
            sprintf('//root/mxCell[@value="%s"][@id="root-id"]/mxGeometry', $sourceClass),
        ];

        $this->assertExtractedAs($xpath, $sourceClass);
    }

    public function testExtractFromClassWithSingleMethod(): void
    {
        $sourceClass = SingleMethod::class;
        $xpath = [
            sprintf(
                '//root/mxCell[@value="%s"][@parent="root-id"]/mxGeometry',
                'Get string with current unix time'
            ),
        ];

        $this->assertExtractedAs($xpath, $sourceClass);
    }

    public function testExtractFromClassWithMultipleMethodsWithInheritance(): void
    {
        $sourceClass = MultipleMethods::class;
        $xpath = [
            sprintf(
                '//root/mxCell[@value="%s"][@parent="root-id"]/mxGeometry',
                'Get string with current unix time'
            ),
            sprintf(
                '//root/mxCell[@value="%s"][@parent="root-id"]/mxGeometry',
                'Get random number'
            ),
        ];

        $this->assertExtractedAs($xpath, $sourceClass);
    }

    public function testExtractSingleCommand(): void
    {
        $sourceClass = CommandMethod::class;
        $xpath = [
            sprintf(
                '//root/mxCell[@value="%s"][@parent="root-id"]'
                    . '[@style="ellipse;whiteSpace=wrap;html=1;fillColor=#dae8fc;strokeColor=#6c8ebf;"]'
                    . '/mxGeometry',
                'Update time'
            ),
        ];

        $this->assertExtractedAs($xpath, $sourceClass);
    }


    public function testExtractSingleQuery(): void
    {
        $sourceClass = QueryMethod::class;
        $xpath = [
            sprintf(
                '//root/mxCell[@value="%s"][@parent="root-id"]'
                . '[@style="ellipse;whiteSpace=wrap;html=1;fillColor=#fff2cc;strokeColor=#d6b656;"]'
                . '/mxGeometry',
                'Update time'
            ),
        ];

        $this->assertExtractedAs($xpath, $sourceClass);
    }

    private function assertExtractedAs(array $xpathList, string $sourceClass): void
    {
        $diagramXml = simplexml_load_string($this->drawIoExtractor->extract($sourceClass));
        foreach ($xpathList as $xpath) {
            $this->assertNotEmpty($diagramXml->xpath($xpath), sprintf('Not found: %s', $xpath));
        }
    }
}
