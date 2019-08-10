<?php
declare(strict_types=1);

namespace Kata\Foxminded\AbstractFactory;

use InvalidArgumentException;
use Kata\Foxminded\AbstractFactory\contracts\LunchFactory;
use Kata\Foxminded\AbstractFactory\it\ItalianLunchFactory;
use Kata\Foxminded\AbstractFactory\ua\UkrainianLunchFactory;

class Client
{
    public const UA = 'ua';
    public const IT = 'it';

    public function main()
    {
        $factory = $this->getFactoryByLocale(self::UA);

        $factory->createDish();
        $factory->createDesert();
    }

    // factory method
    private function getFactoryByLocale(string $locale): LunchFactory
    {
        switch ($locale) {
            case static::UA:
                return new UkrainianLunchFactory();
            case static::IT:
                return new ItalianLunchFactory();
        }

        throw new InvalidArgumentException(sprintf("Invalid type: %s", $locale));
    }
}
