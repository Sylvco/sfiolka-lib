<?php

namespace Sfiolka\SfiolkaLib;

use DateTime;

class DateUtil
{

    public static function nowFilenameFormat(): string
    {
        return self::format(new DateTime(), 'Y-m-d-H-i-s');
    }

    public static function nowMysqlFormat(): string
    {
        return self::formatMysql(new DateTime());
    }

    public static function formatMysql(DateTime $dateTime): string
    {
        return self::format($dateTime, 'Y-m-d H:i:s');
    }

    private static function format(DateTime $dateTime, string $format): string
    {
        return $dateTime->format($format);
    }
}