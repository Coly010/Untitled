<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 06/02/2017
 * Time: 00:35
 */

namespace System\Libraries\UWebAdmin\Pages\Users\Routes;


use System\Libraries\UWebAdmin\DataProcesses\Admin_DataProcess;
use System\Libraries\UWebAdmin\Models\Users\User;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use System\Libraries\UWebAdmin\UWA;
use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\Route;

class DoEditUser_Route extends Route
{

    public function __construct()
    {
        parent::__construct();

        $this->Request = "user/edit/do";
        $this->RenderView = true;
        $this->ViewFilePath = "UWA/Dashboard/Users/edit.html";
        $this->DataProcess = new Admin_DataProcess();
        $this->RouteGuard = new AuthenticatedUser_Guard();

        $this->ViewData['page_name'] = "Edit User";
    }

    /**
     * Run the data process
     */
    public function RunDataProcess()
    {
        if($edited = $this->DataProcess->EditUser()){
            $this->ViewData['result'] = true;
            $this->ViewData['edited_user'] = $edited->ToArray();
        }

        foreach(UWA::GetUsers() as $user){
            $this->ViewData["all_users"][] = $user->ToArray();
        }

        $Me = new User(Session::Get("user")['Id']);
        UWA::NewActivity($Me, $Me->Name." edited user ".$edited->Name.".", time());
    }
}