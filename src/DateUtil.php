<?php

namespace Sfiolka\SfiolkaLib;

use DateTime;

class DateUtil
{

    public static function formatMysql(DateTime $dateTime): string
    {
        return self::format($dateTime, 'Y-m-d H:i:s');
    }

    private static function format(DateTime $dateTime, string $format): string
    {
        return $dateTime->format($format);
    }
}