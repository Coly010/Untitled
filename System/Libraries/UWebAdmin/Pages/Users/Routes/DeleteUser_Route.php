<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 06/02/2017
 * Time: 21:20
 */

namespace System\Libraries\UWebAdmin\Pages\Users\Routes;


use System\Libraries\UWebAdmin\DataProcesses\Admin_DataProcess;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use System\Libraries\UWebAdmin\UWA;
use Untitled\PageBuilder\Route;

class DeleteUser_Route extends Route
{

    public function __construct()
    {
        parent::__construct();

        $this->Request = "user/delete";
        $this->RenderView = true;
        $this->ViewFilePath = "UWA/Dashboard/Users/delete.html";
        $this->DataProcess = new Admin_DataProcess();
        $this->RouteGuard = new AuthenticatedUser_Guard();
        $this->ViewData['page_name'] = "Delete User";
    }

    public function RunDataProcess()
    {
        foreach(UWA::GetUsers() as $user){
            $this->ViewData["all_users"][] = $user->ToArray();
        }
    }


}