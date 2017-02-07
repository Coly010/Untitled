<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 03/01/2017
 * Time: 03:21
 */

namespace Application\Pages\Home\Routes;

use Application\DataProcesses\DatabaseTest;
use Untitled\Libraries\Input\Input;
use Untitled\PageBuilder\Route;

class Homepage_Route extends Route
{

    /**
     * Homepage_Route constructor.
     */
    public function __construct() {
        parent::__construct();

        $this->Request = "home";
        $this->RenderView = true;
        $this->ViewFilePath = "Home/index.html";
        $this->DataProcess = new DatabaseTest();
    }

    /**
     * Run the data process
     */
    public function RunDataProcess()
    {
        if($post = Input::Post("test")){
            echo $post;
        }
    }

}