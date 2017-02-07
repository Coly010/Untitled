<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 06/02/2017
 * Time: 15:06
 */

namespace System\Libraries\UWebAdmin\Pages\Users\Routes;


use System\Libraries\UWebAdmin\Pages\Register\Routes\RegisterHome_Route;

class AddUser_Route extends RegisterHome_Route
{

    public function __construct(){
        parent::__construct();

        $this->Request = "user/add";
        $this->ViewFilePath = "UWA/Dashboard/Users/add.html";
    }

}