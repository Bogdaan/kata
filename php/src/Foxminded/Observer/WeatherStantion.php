<?php
declare(strict_types=1);

namespace Kata\Foxminded\Observer;

use Kata\Foxminded\Observer\observers\ObserverInterface;

class WeatherStantion
{
    /**
     * @var ObserverInterface
     */
    private $observers;

    public function addObserver(ObserverInterface $observer): void
    {
        $this->observers[] = $observer;
    }

    public function updateForecast(): void
    {
        $this->notifyAboutStorm();
    }

    private function notifyAboutStorm(): void
    {
        /** @var ObserverInterface $observer */
        foreach($this->observers as $observer) {
            $observer->stormWarning();
        }
    }
}
