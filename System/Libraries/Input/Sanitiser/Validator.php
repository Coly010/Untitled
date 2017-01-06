<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 04/01/2017
 * Time: 11:47
 */

namespace Untitled\Libraries\Input\Sanitiser;


class Validator
{

    /**
     * Check if value is between a range
     * @param $value - value given
     * @param $min - lower bound
     * @param $max - upper bound
     * @return bool - result
     */
    public static function BetweenRange($value, $min, $max){
        return is_numeric($value) && is_numeric($min) && is_numeric($max) ? $value >= $min && $value <= $max : false;
    }

    /**
     * Check if the string is letters only
     * @param $value - string to check
     * @return bool|int - result
     */
    public static function LettersOnly($value){
        return is_string($value) ? preg_match("/^[a-zA-Z ]*$/", $value) : false;
    }

    /**
     * Check if string is a valid email address
     * @param $value - email
     * @return bool|mixed - result
     */
    public static function Email($value){
        return is_string($value) ? filter_var($value, FILTER_VALIDATE_EMAIL) : false;
    }

    /**
     * Check if string is valid URL
     * @param $value - Url string
     * @return bool|mixed - result
     */
    public static function Url($value){
        return is_string($value) ? filter_var($value, FILTER_VALIDATE_URL) : false;
    }

    /**
     * Check if variable is not empty
     * @param $value - Value to check
     * @return bool - result
     */
    public static function NotEmpty($value){
        return is_string($value) ? !empty(trim($value)) : false;
    }

    /**
     * Check if length of string is less than limit
     * @param $value - Value to check
     * @param $limit - limit to check against
     * @return bool - result
     */
    public static function LengthLessThan($value, $limit){
        return is_string($value) ? strlen($value) < $limit : false;
    }

    /**
     * Check if length of string is greater than limit
     * @param $value - Value to check
     * @param $limit - limit to check against
     * @return bool - result
     */
    public static function LengthGreaterThan($value, $limit){
        return is_string($value) ? strlen($value) > $limit : false;
    }

    /**
     * Check if value is greater than limit
     * @param $value - Value to check
     * @param $limit - limit to check against
     * @return bool - result
     */
    public static function GreaterThan($value, $limit) {
        return is_numeric($value) ? $value > $limit : false;
    }

    /**
     * Check if value is less than limit
     * @param $value - Value to check
     * @param $limit - limit to check against
     * @return bool - result
     */
    public static function LessThan($value, $limit) {
        return is_numeric($value) ? $value < $limit : false;
    }

}