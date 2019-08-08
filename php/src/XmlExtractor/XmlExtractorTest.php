<?php
declare(strict_types=1);

namespace Kata\XmlExtractor;

use InvalidArgumentException;
use Kata\XmlExtractor\samples\EmptyClass;
use Kata\XmlExtractor\samples\SingleMethod;
use PHPUnit\Framework\TestCase;

class XmlExtractorTest extends TestCase
{
    public function testExtractFromClassWithoutMethods(): void
    {
        $sourceClass = EmptyClass::class;
        $xml = <<<XML
        <mxCell id="root-id" value="{$sourceClass}" style="swimlane;" parent="1" vertex="1">
          <mxGeometry x="0" y="0" width="200" height="200" as="geometry"/>
        </mxCell>
XML;

        $this->assertExtracted($xml, $sourceClass);
    }

    public function testExtractFromClassWithSingleMethod(): void
    {
        $sourceClass = SingleMethod::class;
        $xml = <<<XML
        <mxCell id="root-id" value="{$sourceClass}" style="swimlane;" parent="1" vertex="1">
          <mxGeometry x="0" y="0" width="200" height="200" as="geometry"/>
        </mxCell>
        <mxCell value="Get string with current unix time" style="ellipse;whiteSpace=wrap;html=1;" parent="root-id" vertex="1">
          <mxGeometry x="1" y="1" width="200" height="70" as="geometry"/>
        </mxCell>
XML;

        $this->assertExtracted($xml, $sourceClass);
    }

    public function testInvalidLayout(): void
    {
        $layout = <<<LAYOUT
<?xml version="1.0" encoding="UTF-8"?>
<mxfile version="11.1.2" type="google" compressed="false">
  <diagram id="use-case" name="use-case diagram">
    <mxGraphModel dx="0" dy="0" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1000" pageHeight="1000" math="0" shadow="0">
    </mxGraphModel>
  </diagram>
</mxfile>
LAYOUT;

        $this->expectException(InvalidArgumentException::class);

        (new XmlExtractor($layout));
    }

    private function assertExtracted(string $expectedXml, string $sourceClass): void
    {
        $layout = $this->createXml();
        $expectedXmlWithLayout = $this->createXml($expectedXml);

        $this->assertSame(
            $this->trimNewlinesAndWhitespaces(
                $expectedXmlWithLayout
            ),
            $this->trimNewlinesAndWhitespaces(
                (new XmlExtractor($layout))->extract($sourceClass)
            )
        );
    }

    private function createXml(string $body = ''): string
    {
        return <<<LAYOUT
<?xml version="1.0" encoding="UTF-8"?>
<mxfile version="11.1.2" type="google" compressed="false">
  <diagram id="use-case" name="use-case diagram">
    <mxGraphModel dx="0" dy="0" grid="1" gridSize="10" guides="1" tooltips="1" connect="1" arrows="1" fold="1" page="1" pageScale="1" pageWidth="1000" pageHeight="1000" math="0" shadow="0">
      <root>
      {$body}
      </root>
    </mxGraphModel>
  </diagram>
</mxfile>
LAYOUT;
    }

    private function trimNewlinesAndWhitespaces(string $multiline): string
    {
        return preg_replace(
            "/\s+/",
            "",
            preg_replace("/\n/", "", $multiline)
        );
    }
}
