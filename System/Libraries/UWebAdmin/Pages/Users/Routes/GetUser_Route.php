<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 06/02/2017
 * Time: 00:52
 */

namespace System\Libraries\UWebAdmin\Pages\Users\Routes;


use System\Libraries\UWebAdmin\DataProcesses\Admin_DataProcess;
use System\Libraries\UWebAdmin\UWA;
use Untitled\Libraries\Input\Input;
use Untitled\PageBuilder\Route;

class GetUser_Route extends Route
{

    /**
     * RegisterHome_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = "user/get";
        $this->RenderView = false;
        $this->DataProcess = new Admin_DataProcess();
    }

    /**
     * Run the data process
     */
    public function RunDataProcess()
    {
        $User = UWA::GetUser(Input::Post("user_id"));
        $User = $User->ToArray();
        unset($User['password']);
        $this->ViewData["found_user"] = $User;
    }
}