<?php
declare(strict_types=1);

namespace Kata\DiagramExtractor;

use Kata\DiagramExtractor\internal\extractor\ReflectionGroupExtractor;
use Kata\DiagramExtractor\internal\formatter\DrawIoXmlFormatter;
use Kata\DiagramExtractor\samples\EmptyClass;
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
        $expected = <<<XML
        <mxCell id="root-id" value="{$sourceClass}" style="swimlane;" parent="1" vertex="1">
          <mxGeometry x="0" y="0" width="200" height="200" as="geometry"/>
        </mxCell>
XML;

        $this->assertExtracted($expected, $sourceClass);
    }

    public function testExtractFromClassWithSingleMethod(): void
    {
        $sourceClass = SingleMethod::class;
        $expected = <<<XML
        <mxCell id="root-id" value="{$sourceClass}" style="swimlane;" parent="1" vertex="1">
          <mxGeometry x="0" y="0" width="200" height="200" as="geometry"/>
        </mxCell>
        <mxCell value="Get string with current unix time" style="ellipse;whiteSpace=wrap;html=1;" parent="root-id" vertex="1">
          <mxGeometry x="1" y="1" width="200" height="70" as="geometry"/>
        </mxCell>
XML;

        $this->assertExtracted($expected, $sourceClass);
    }

    private function assertExtracted(string $expectedXml, string $sourceClass): void
    {
        $this->assertContains(
            $this->normalize($expectedXml),
            $this->normalize($this->drawIoExtractor->extract($sourceClass))
        );
    }

    private function normalize(string $multilineText): string
    {
        return preg_replace(
            "/\s+/",
            "",
            preg_replace("/\n/", "", $multilineText)
        );
    }
}
