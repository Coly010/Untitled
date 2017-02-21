<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 26/01/2017
 * Time: 16:51
 */

namespace System\Libraries\UWebAdmin\Pages\Login\Routes;


use System\Libraries\UWebAdmin\DataProcesses\Login_DataProcess;
use Untitled\PageBuilder\Route;

class LoginHome_Route extends Route
{

    /**
     * LoginHome_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = "login";
        $this->RenderView = true;
        $this->ViewFilePath = "UWA/Login/index.html";
        $this->DataProcess = new Login_DataProcess();
        $this->ViewData['page_name'] = "Login";
    }

    /**
     * Run the data process
     */
    public function RunDataProcess()
    {
        // TODO: Implement RunDataProcess() method.
    }

}