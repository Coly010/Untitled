<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 05/02/2017
 * Time: 16:49
 */

namespace System\Helpers\DateTime;


class DateTime_Helper
{

    /**
     * Convert time to a time ago
     * @param $time - time stamp
     * @return string - the time ago string
     */
    public static function TimeAgo($time)
    {
        $diff = time() - $time;

        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'min',
            1 => 'sec'
        );

        foreach($tokens as $unit => $text){
            if($diff < $unit)
                continue;
            $remaining = floor($diff / $unit);
            return $remaining. " ". $text . ($remaining > 1 ) ? "s ago" : "ago";
        }
    }

    /**
     * Convert timestamp to Date and Time
     * @param $timestamp
     * @return string
     */
    public static function ConvertTimeFullDateWithTime($timestamp){
        $date = self::ConvertTimeFullDate($timestamp);
        $time = self::ConvertTimeHoursMins($timestamp);
        return $date. " " .$time;
    }

    /**
     * Convert timestamp to Full date
     * @param $timestamp
     * @return false|string
     */
    public static function ConvertTimeFullDate($timestamp){
        return date("D, jS M Y", $timestamp);
    }

    /**
     * Convert timestamp to Hours and Mins
     * @param $timestamp
     * @return false|string
     */
    public static function ConvertTimeHoursMins($timestamp){
        return date("H:i", $timestamp);
    }

}