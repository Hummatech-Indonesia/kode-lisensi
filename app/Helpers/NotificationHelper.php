<?php

namespace App\Helpers;

use App\Base\Container\NotificationContainer;
use App\Base\Interfaces\Notification\CountInterface;
use App\Base\Interfaces\Notification\TakeInterface;

class NotificationHelper extends NotificationContainer implements CountInterface, TakeInterface
{
    /**
     * count provided notifications
     *
     * @return int
     */

    public static function count(): int
    {
        return count(self::baseNotification());
    }   

    /**
     * Get all notifications with provided parameter
     *
     * @param int $take
     *
     * @return object|null
     */

    public static function take(int $take = 10): object|null
    {
        return self::baseNotification()->take($take);
    }
}
