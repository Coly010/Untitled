<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 26/01/2017
 * Time: 17:11
 */

namespace System\Libraries\UWebAdmin\Pages\Register\Routes;


use System\Libraries\UWebAdmin\DataProcesses\Register_DataProcess;
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
    }

    /**
     * Run data process
     */
    public function RunDataProcess()
    {
        $this->DataProcess->Register();
    }

}