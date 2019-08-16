<?php
declare(strict_types=1);

namespace Kata\Foxminded\Observer;

use Kata\Foxminded\Observer\observers\Hospital;
use Kata\Foxminded\Observer\observers\School;

class Client
{
    public function main()
    {
        $stantion = new WeatherStantion();
        $stantion->addObserver(new School());
        $stantion->addObserver(new Hospital());
        $stantion->updateForecast();
    }
}
