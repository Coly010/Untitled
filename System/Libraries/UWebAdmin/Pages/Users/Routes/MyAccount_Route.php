<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 07/02/2017
 * Time: 00:37
 */

namespace System\Libraries\UWebAdmin\Pages\Users\Routes;


use System\Libraries\UWebAdmin\DataProcesses\Admin_DataProcess;
use System\Libraries\UWebAdmin\Models\Users\User;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\Route;

class MyAccount_Route extends Route
{

    public function __construct()
    {
        parent::__construct();

        $this->Request = "user/me/account";
        $this->RenderView = true;
        $this->ViewFilePath = "UWA/Dashboard/Users/me.html";
        $this->DataProcess = new Admin_DataProcess();
        $this->RouteGuard = new AuthenticatedUser_Guard();


        $this->ViewData['page_name'] = "My Account";
    }

    public function RunDataProcess()
    {
        $this->ViewData['me'] = new User(Session::Get("user")['Id']);
    }


}