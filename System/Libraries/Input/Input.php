<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 04/01/2017
 * Time: 11:43
 */

namespace Untitled\Libraries\Input;

class Input
{

    /**
     * Return a value that was sent with a GET request
     * @param $key - Key of the value
     * @return bool/mixed - the value or false if invalid key
     */
    public static function Get($key) {
        return isset($_GET[$key]) ? $_GET[$key] : false;
    }

    /**
     * Return a value that was sent with a POST request
     * @param $key - Key of the value
     * @return bool/mixed - the value or false if invalid key
     */
    public static function Post($key) {
        return isset($_POST[$key]) ? $_POST[$key] : false;
    }

}