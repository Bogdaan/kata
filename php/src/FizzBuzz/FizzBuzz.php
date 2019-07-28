<?php
declare(strict_types=1);

namespace Kata\FizzBuzz;

class FizzBuzz
{
    public function of(int $num): string
    {
        if ($this->isDivisibleByThreeAndFive($num)) {
            return 'FizzBuzz';
        } elseif ($this->isDivisibleByThree($num)) {
            return 'Fizz';
        } elseif ($this->isDivisibleByFive($num)) {
            return 'Buzz';
        }

        return (string) $num;
    }

    private function isDivisibleByThreeAndFive(int $num): bool
    {
        return $this->isDivisibleByThree($num) && $this->isDivisibleByFive($num);
    }

    private function isDivisibleByThree(int $num): bool
    {
        return $num % 3 === 0;
    }

    private function isDivisibleByFive(int $num): bool
    {
        return $num % 5 === 0;
    }
}
