<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 06/02/2017
 * Time: 15:18
 */

namespace System\Libraries\UWebAdmin\Pages\Users\Routes;


use System\Libraries\UWebAdmin\Pages\Register\Routes\DoRegister_Route;

class DoAddUser_Route extends DoRegister_Route
{

    public function __construct()
    {
        parent::__construct();

        $this->Request = "user/add/do";
        $this->ViewFilePath = "UWA/Dashboard/Users/add.html";
    }

}