<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 04/01/2017
 * Time: 10:31
 */

namespace Untitled\Libraries\Session;


class Session
{

    public static $SESSION_STARTED = false;

    /**
     * Session constructor.
     */
    public static function Start()
    {
        if(!self::$SESSION_STARTED){
            session_start();
            self::$SESSION_STARTED = true;
        }
    }

    /**
     * Add a key value pair to the global Session array
     * @param $key string - the key to add
     * @param $item mixed - the value to add
     * @throws \Exception - If key is not string, throw an exception
     */
    public static function Add($key, $item){
        if(!is_array($key) && is_string($key))
            $_SESSION[$key] = $item;
        else
            throw new \Exception("Session Library - Invalid key to add to session.");
    }

    /**
     * Remove a key value pair from the global Session array
     * @param $key string - the key of the pair to remove
     * @throws \Exception - if key is not string or the key is not present in the array, throw an exception
     */
    public static function Remove($key){
        if(is_string($key) && in_array($key, $_SESSION) && isset($_SESSION[$key]))
            unset($_SESSION[$key]);
        else
            throw new \Exception("Session Library - Trying to remove key that does not exist.");
    }

    /**
     * Return the value from a key value pair in the global session array
     * @param $key - key of pair to return
     * @return mixed - the value of the pair or false if doesn't exist
     */
    public static function Get($key){
        return is_string($key) && isset($_SESSION[$key]) ? $_SESSION[$key] : false;
    }

    /**
     * Regenerate session id
     */
    public static function Regenerate(){
        session_regenerate_id();
    }

    /**
     * Destroy the session
     */
    public static function Destroy(){
        session_destroy();
    }

}