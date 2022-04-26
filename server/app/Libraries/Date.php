<?php

namespace App\Libraries;

class Date
{
    public static function formatToTime($format, $strTime)
    {
        $dateTime = \DateTime::createFromFormat($format, $strTime);
        if (is_object($dateTime) && $dateTime->format($format) == $strTime) {
            return $dateTime->getTimestamp();
        } else {
            return false;
        }
    }
}
