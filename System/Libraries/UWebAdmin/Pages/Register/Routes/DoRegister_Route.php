<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 26/01/2017
 * Time: 17:11
 */

namespace System\Libraries\UWebAdmin\Pages\Register\Routes;


use System\Libraries\UWebAdmin\DataProcesses\Register_DataProcess;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\PageBuilder\Route;

class DoRegister_Route extends Route
{

    /**
     * DoRegister_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = "register/do";
        $this->RenderView = true;
        $this->ViewFilePath = "UWA/Register/index.html";
        $this->DataProcess = new Register_DataProcess();
        $this->RouteGuard = new AuthenticatedUser_Guard();
    }

    /**
     * Run data process
     */
    public function RunDataProcess()
    {
        $registered_user = $this->DataProcess->Register();
        if($registered_user != false){
            $this->ViewData["result"] = true;
            $this->ViewData["new_user"] = $registered_user->ToArray();
        } else {
            $this->ViewData["result"] = false;
        }
    }

}