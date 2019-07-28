<?php
declare(strict_types=1);

namespace Kata\WordWrap;

use PHPUnit\Framework\TestCase;

class WordWrapTest extends TestCase
{
    /**
     * @var WordWrap
     */
    private $wordWrap;

    protected function setUp()
    {
        $this->wordWrap = new WordWrap();
    }

    /**
     * @param string $expected
     * @param string $input
     * @param int $limit
     * @dataProvider samplesProvider
     */
    public function testSamples(string $expected, string $input, int $limit)
    {
        $this->assertSame(
            $expected,
            $this->wordWrap->wrap($input, $limit),
            sprintf("limit: %s", $limit)
        );
    }

    public function samplesProvider(): array
    {
        return [
            'one word' => [
                'expected' => "test",
                'input' => 'test',
                'limit' => 7,
            ],
            'two words in two lines' => [
                'expected' => "hello\nworld",
                'input' => 'hello world',
                'limit' => 7,
            ],
            'lot of words with newlines' => [
                'expected' => "a lot of\nwords for\na single\nline",
                'input' => 'a lot of words for a single line',
                'limit' => 10,
            ],
            'lot of words with boundaries' => [
                'expected' => "this\nis a\ntest",
                'input' => 'this is a test',
                'limit' => 4,
            ],
            'lot of words with word break' => [
                'expected' => "a long\nword",
                'input' => 'a longword',
                'limit' => 6,
            ],
            'single word with multiple breaks' => [
                'expected' => "areall\nylongw\nord",
                'input' => 'areallylongword',
                'limit' => 6,
            ],
        ];
    }
}
