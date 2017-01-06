<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 04/01/2017
 * Time: 11:47
 */

namespace Untitled\Libraries\Input\Sanitiser;


class Sanitiser
{

    /**
     * Sanitise Int
     * @param $value - value to check
     * @return mixed - sanitised value
     */
    public static function Int($value) {
        return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Sanitise Number
     * @param $value - value to check
     * @return mixed - sanitised value
     */
    public static function Number($value) {
        return filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT);
    }

    /**
     * Sanitise String
     * @param $value - value to check
     * @return mixed - sanitised value
     */
    public static function String($value) {
        return filter_var($value, FILTER_SANITIZE_STRING);
    }

    /**
     * Sanitise Email
     * @param $value - value to check
     * @return mixed - sanitised value
     */
    public static function Email($value) {
        return filter_var($value, FILTER_SANITIZE_EMAIL);
    }

    /**
     * Sanitise Url
     * @param $value - value to check
     * @return mixed - sanitised value
     */
    public static function Url($value) {
        return filter_var($value, FILTER_SANITIZE_URL);
    }

}