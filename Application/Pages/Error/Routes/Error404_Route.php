<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 04/01/2017
 * Time: 02:11
 */

namespace Application\Pages\Error\Routes;

use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\Route;

class Error404_Route extends Route
{

    public function __construct() {
        parent::__construct();

        $this->RequestType = "GET";
        $this->Request = "error404";
        $this->RenderView = true;
        $this->ViewFilePath = "Error/404.html";
    }

    public function RunDataProcess()
    {
    }

}