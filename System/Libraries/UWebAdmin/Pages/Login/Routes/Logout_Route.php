<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 07/02/2017
 * Time: 01:35
 */

namespace System\Libraries\UWebAdmin\Pages\Login\Routes;


use System\Libraries\UWebAdmin\DataProcesses\Admin_DataProcess;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\Route;

class Logout_Route extends Route
{

    public function __construct()
    {
        parent::__construct();

        $this->Request = "login/logout";
        $this->RenderView = true;
        $this->ViewFilePath = "UWA/Login/index.html";
        $this->DataProcess = new Admin_DataProcess();
        $this->RouteGuard = new AuthenticatedUser_Guard();
        $this->ViewData['page_name'] = "Login";
    }

    public function RunDataProcess()
    {
        Session::Destroy();

        $this->ViewData['logout'] = true;
    }


}