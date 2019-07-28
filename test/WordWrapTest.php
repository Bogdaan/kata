<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class WordWrapTest extends TestCase
{
    public function testSingleWordWithinLimit()
    {
        $this->assertWrapped('test', 'test', 4);
    }

    public function testSingleWordExceedsLimitOneTime()
    {
        $this->assertWrapped("super\nman", 'superman', 5);
    }

    public function testSingleWordExceedsLimitTwoTimes()
    {
        $this->assertWrapped("sup\nerm\nan", 'superman', 3);
    }

    public function testSecondWordWrapped()
    {
        $this->assertWrapped("to\nLondon", 'to London', 6);
    }

    public function testSingleLineBrakeAndSecondWordSplit()
    {
        $this->assertWrapped("to\nLond\non", 'to London', 4);
    }

    private function assertWrapped(string $expected, string $input, int $limit): void
    {
        $wrap = new WordWrap();
        $this->assertSame($expected, $wrap->wrap($input, $limit));
    }
}
