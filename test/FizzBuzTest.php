<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class FizzBuzTest extends TestCase
{
    const FIZZ = 'Fizz';
    const BUZZ = 'Buzz';
    const FIZZ_BUZZ = 'FizzBuzz';

    /**
     * @var FizzBuzz
     */
    private $fizzBuzz;

    protected function setUp()
    {
        $this->fizzBuzz = new FizzBuzz();
        parent::setUp();
    }

    public function testOneIsOne()
    {
        $this->assertSameStringNumber(1);
    }

    public function testThreeIsFizz()
    {
        $this->assertFizz(3);
    }

    public function testFiveIsBuzz()
    {
        $this->assertBuzz(5);
    }

    public function testSixIsFizz()
    {
        $this->assertFizz(6);
    }

    public function testTenIsBuzz()
    {
        $this->assertBuzz(10);
    }

    public function testFifteenIsFizzBuzz()
    {
        $this->assertFizzBuzz(15);
    }

    public function testThirtyIsFizzBuzz()
    {
        $this->assertFizzBuzz(30);
    }

    private function assertFizz(int $num): void
    {
        $this->assertSame(self::FIZZ, $this->fizzBuzz->of($num));
    }

    private function assertBuzz(int $num): void
    {
        $this->assertSame(self::BUZZ, $this->fizzBuzz->of($num));
    }

    private function assertFizzBuzz(int $num): void
    {
        $this->assertSame(self::FIZZ_BUZZ, $this->fizzBuzz->of($num));
    }

    private function assertSameStringNumber(int $num): void
    {
        $this->assertSame((string)$num, $this->fizzBuzz->of($num));
    }
}
