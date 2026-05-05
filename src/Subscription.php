<?php

namespace App;

use DateTime;
use Exception;

class Subscription
{
    public DateTime $startedAt;
    public DateTime $expiresAt;

    public function __construct(DateTime $startedAt, DateTime $expiresAt)
    {
        if ($startedAt > $expiresAt) {
            throw new Exception("Дата начала подписки не должна быть позже даты окончания");
        }

        $this->startedAt = $startedAt;
        $this->expiresAt = $expiresAt;
    }

    public function isExpired(): bool
    {
        $now = new DateTime();
        
        return $now > $this->expiresAt;
    }

    public function getRemainingDays(): int
    {
        if ($this->isExpired()) {
            return 0;
        }

        $now = new DateTime();
        $diff = $now->diff($this->expiresAt);
        
        return $diff->days;
    }

    public function extend(int $days): void
    {
        if ($days <= 0) {
            throw new Exception("Количество дней должно быть больше нуля");
        }

        $this->expiresAt->modify("+" . $days . " days");
    }
}
