<?php

namespace App;

use DateTime;
use Exception;

class ParkingSession
{
    public DateTime $startedAt;
    public ?DateTime $endedAt = null;

    public function __construct(DateTime $startedAt)
    {
        $this->startedAt = $startedAt;
    }

    public function getDurationMinutes(): int
    {
        $end = $this->endedAt;
        if ($end === null) {
            $end = new DateTime();
        }

        if ($this->startedAt > $end) {
            throw new Exception("Дата заезда не должна быть позже даты выезда");
        }

        $diffSeconds = $end->getTimestamp() - $this->startedAt->getTimestamp();
        
        return (int)($diffSeconds / 60);
    }

    public function calculatePrice(float $pricePerHour): float
    {
        if ($pricePerHour < 0) {
            throw new Exception("Цена за час должна быть положительной");
        }

        $hours = $this->getDurationMinutes() / 60;
        
        return $hours * $pricePerHour;
    }
}
