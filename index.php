<?php

require_once 'vendor/autoload.php';

use App\ParkingSession;
use App\Subscription;

try {
    $startedAt = new DateTime('-2 hours -30 minutes');
    $parking = new ParkingSession($startedAt);
    
    echo "Минут на парковке: " . $parking->getDurationMinutes() . "\n";
    echo "Стоимость парковки (100 р. в час): " . $parking->calculatePrice(100.0) . "\n\n";

    $subStart = new DateTime();
    $subEnd = (new DateTime())->modify('+10 days');
    $subscription = new Subscription($subStart, $subEnd);
    
    echo "Подписка истекла? " . ($subscription->isExpired() ? 'Да' : 'Нет') . "\n";
    echo "Осталось дней: " . $subscription->getRemainingDays() . "\n";
    
    $subscription->extend(5);
    echo "Продлили на 5 дней. Осталось дней: " . $subscription->getRemainingDays() . "\n";

} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage() . "\n";
}
