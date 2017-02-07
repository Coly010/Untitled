<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 06/02/2017
 * Time: 00:29
 */

namespace System\Libraries\UWebAdmin\Pages\Users\Routes;


use System\Libraries\UWebAdmin\DataProcesses\Admin_DataProcess;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use System\Libraries\UWebAdmin\UWA;
use Untitled\PageBuilder\Route;

class EditUser_Route extends Route
{

    /**
     * RegisterHome_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = "user/edit";
        $this->RenderView = true;
        $this->ViewFilePath = "UWA/Dashboard/Users/edit.html";
        $this->DataProcess = new Admin_DataProcess();
        $this->RouteGuard = new AuthenticatedUser_Guard();
    }

    /**
     * Run the data process
     */
    public function RunDataProcess()
    {
        foreach(UWA::GetUsers() as $user){
            $this->ViewData["all_users"][] = $user->ToArray();
        }
    }

}