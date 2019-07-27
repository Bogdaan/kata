<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class WordWrapTest extends TestCase
{
    public function testSingleWordWithinLimit()
    {
        $this->assertWrap('test', 'test', 4);
    }

    public function testSingleWordExceedsLimitOneTime()
    {
        $this->assertWrap("super\nman", 'superman', 5);
    }

    public function testSingleWordExceedsLimitTwoTimes()
    {
        $this->assertWrap("sup\nerm\nan", 'superman', 3);
    }

    public function testSecondWordWrapped()
    {
        $this->assertWrap("to\nLondon", 'to London', 6);
    }

    public function testSingleLineBrakeAndSecondWordSplit()
    {
        $this->assertWrap("to\nLond\non", 'to London', 4);
    }

    private function assertWrap(string $expected, string $input, int $limit): void
    {
        $wrap = new WordWrap();
        $this->assertSame($expected, $wrap->wrap($limit, $input));
    }
}
