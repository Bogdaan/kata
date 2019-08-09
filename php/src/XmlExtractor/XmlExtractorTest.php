<?php
declare(strict_types=1);

namespace Kata\XmlExtractor;

use Kata\XmlExtractor\internal\extractor\ReflectionGroupExtractor;
use Kata\XmlExtractor\internal\formatter\DrawIoXmlFormatter;
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

    private function assertExtracted(string $expectedXml, string $sourceClass): void
    {
        $extractor = new XmlExtractor(new ReflectionGroupExtractor(), new DrawIoXmlFormatter());

        $this->assertContains(
            $this->normalize($expectedXml),
            $this->normalize($extractor->extract($sourceClass))
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
