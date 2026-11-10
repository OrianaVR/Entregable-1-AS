<?php

/**
 * @author Oriana
 */

namespace App\Utils;

class DeliveryDateUtil
{
    public const BUSINESS_DAYS = 8;

    public static function estimatedDate(): string
    {
        return now()->addWeekdays(self::BUSINESS_DAYS)->format('Y-m-d');
    }
}
