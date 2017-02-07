<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 26/01/2017
 * Time: 17:16
 */

namespace System\Libraries\UWebAdmin\Pages\Dashboard\Routes;


use System\Helpers\DateTime\DateTime_Helper;
use System\Libraries\UWebAdmin\DataProcesses\Admin_DataProcess;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use System\Libraries\UWebAdmin\UWA;
use System\PageBuilder\RouteGuard;
use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\Route;

class DashboardHome_Route extends Route
{

    /**
     * DashboardHome_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = "dashboard";
        $this->RenderView = true;
        $this->ViewFilePath = "UWA/Dashboard/index.html";
        $this->DataProcess = new Admin_DataProcess();

        $this->RouteGuard = new AuthenticatedUser_Guard();
    }

    /**
     * Run data process
     */
    public function RunDataProcess()
    {
        $latest_activity = UWA::GetLatestActivity(10);
        foreach($latest_activity as $la){
            $la = $la->ToArray();
            $la["time"] = DateTime_Helper::ConvertTimeFullDateWithTime($la['time']);
            $this->ViewData["latest_activity"][] = $la;
        }
    }

}