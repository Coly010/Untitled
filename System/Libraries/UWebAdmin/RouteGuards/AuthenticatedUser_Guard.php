<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 05/02/2017
 * Time: 14:57
 */

namespace System\Libraries\UWebAdmin\RouteGuards;

use System\PageBuilder\RouteGuard;

class AuthenticatedUser_Guard extends RouteGuard
{

    /**
     * AuthenticatedUser_Guard constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->DenyRequestString = "/login";
        $this->GuardFunction = function() {
            Session::Start();
            if(!Session::Get("user")){
                return false;
            }
            return true;
        };
    }

}