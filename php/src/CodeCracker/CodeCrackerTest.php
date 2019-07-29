<?php
declare(strict_types=1);

namespace Kata\CodeCracker;

use PHPUnit\Framework\TestCase;

class CodeCrackerTest extends TestCase
{
    public function testCrackEmptyString()
    {
        $this->assertCracked('', '', '', '');
    }

    public function testCrackMessageWithoutAlphabetAndKey()
    {
        $this->assertCracked('test', 'test', '', '');
    }

    public function testCrackMessageWithNumbericKey()
    {
        $this->assertCracked('abcd', '1234', 'abcd', '1234');
    }

    public function testCrackMessageWithIncomplateKey()
    {
        $this->assertCracked('test abc', 'test 123', 'abc', '123');
    }

    public function assertCracked(string $result, string $message, string $alphabet, string $key)
    {
        $cracker = new CodeCracker($alphabet, $key);

        $this->assertSame($result, $cracker->crack($message));
    }
}
