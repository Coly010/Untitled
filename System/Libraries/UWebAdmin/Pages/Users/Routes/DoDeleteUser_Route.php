<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 06/02/2017
 * Time: 21:20
 */

namespace System\Libraries\UWebAdmin\Pages\Users\Routes;


use System\Libraries\UWebAdmin\DataProcesses\Admin_DataProcess;
use System\Libraries\UWebAdmin\Models\Users\User;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use System\Libraries\UWebAdmin\UWA;
use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\Route;

class DoDeleteUser_Route extends Route
{

    public function __construct()
    {
        parent::__construct();

        $this->Request = "user/delete/do";
        $this->RenderView = true;
        $this->ViewFilePath = "UWA/Dashboard/Users/delete.html";
        $this->DataProcess = new Admin_DataProcess();
        $this->RouteGuard = new AuthenticatedUser_Guard();

        $this->ViewData['page_name'] = "Delete User";
    }

    public function RunDataProcess()
    {
        $deleted = $this->DataProcess->DeleteUser();
        if($deleted != false){
            $this->ViewData['result'] = true;
            $this->ViewData['deleted_user'] = $deleted->ToArray();
        }

        foreach(UWA::GetUsers() as $user){
            $this->ViewData["all_users"][] = $user->ToArray();
        }

        $Me = new User(Session::Get("user")['Id']);
        UWA::NewActivity($Me, $Me->Name." deleted user ".$deleted->Name.".", time());
    }


}