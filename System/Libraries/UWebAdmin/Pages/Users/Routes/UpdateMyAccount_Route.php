<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 07/02/2017
 * Time: 00:37
 */

namespace System\Libraries\UWebAdmin\Pages\Users\Routes;


use System\Libraries\UWebAdmin\DataProcesses\Admin_DataProcess;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\PageBuilder\Route;

class UpdateMyAccount_Route extends Route
{

    public function __construct()
    {
        parent::__construct();

        $this->Request = "user/me/account/update";
        $this->RenderView = true;
        $this->ViewFilePath = "UWA/Dashboard/Users/me.html";
        $this->DataProcess = new Admin_DataProcess();
        $this->RouteGuard = new AuthenticatedUser_Guard();
    }

    public function RunDataProcess()
    {
        if($this->DataProcess->UpdateMyAccount()){
            $this->ViewData['result'] = true;
        }
    }


}