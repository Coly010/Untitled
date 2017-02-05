<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 04/02/2017
 * Time: 02:15
 */

namespace System\PageBuilder;


class RouteGuard
{

    /**
     * @var string Request to send user to if they dont meet the requirements
     */
    public $DenyRequestString;

    /**
     * @var boolean the result of the guard
     */
    public $Result;

    /**
     * @var string Function to call to check guard
     */
    public $GuardFunction;


    /**
     * RouteGuard constructor.
     */
    public function __construct()
    {
    }

    /**
     * Determine whether the client can access
     * @return bool
     */
    public  function Guard(){
        $func = $this->GuardFunction;
        $this->Result = $func();

        return $this->Result;
    }

}