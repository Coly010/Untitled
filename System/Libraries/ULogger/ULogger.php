<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 04/01/2017
 * Time: 04:25
 */

namespace Untitled\Libraries\ULogger;


class ULogger
{
    /**
     * @var Heading of the log
     */
    private static $Header;

    /**
     * @var The body of the log
     */
    private static $LogBody;

    /**
     * Set the heading of the log
     * @param $header Heading
     */
    public static function SetLogHeader($header){
        self::$Header = "<h3>" . $header . "</h3><hr />";
    }

    /**
     * Add some text to the log body
     * @param $text Log body
     */
    public static function AddToLog($text){
        self::$LogBody .= "<p>" . $text . "</p>";
    }

    /**
     * Print the log to the screen
     */
    public static function ShowLog(){
        $log = "<div class='log' style='background-color: #101010; color: #ffffff; border: solid 1px #c3c3c3; padding: 8px; margin: 4px; font-family: sans-serif;'>"
            . self::$Header
            . "<p>" . self::$LogBody . "</p>"
            . "</div>";
        echo $log;
    }

    /**
     * Simple method to make a quick log
     * @param $header log heading
     * @param $text log body
     */
    public static function Log($header, $text){
        self::SetLogHeader($header);
        self::AddToLog($text);
        self::ShowLog();
    }

}