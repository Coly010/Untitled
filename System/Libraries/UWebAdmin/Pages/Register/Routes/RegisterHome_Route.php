<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 26/01/2017
 * Time: 16:57
 */

namespace System\Libraries\UWebAdmin\Pages\Register\Routes;


use System\Libraries\UWebAdmin\DataProcesses\Register_DataProcess;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\PageBuilder\Route;

class RegisterHome_Route extends Route
{

    /**
     * RegisterHome_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = "register";
        $this->RenderView = true;
        $this->ViewFilePath = "UWA/Register/index.html";
        $this->DataProcess = new Register_DataProcess();
        $this->RouteGuard = new AuthenticatedUser_Guard();
    }

    /**
     * Run the data process
     */
    public function RunDataProcess()
    {

    }

}