<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 05/02/2017
 * Time: 15:11
 */

namespace Application\Pages\UWA\Routes\Users;


use System\Libraries\UWebAdmin\Pages\Register\Routes\RegisterHome_Route;

class AddUser_Route extends RegisterHome_Route
{

    public function __construct(){
        parent::__construct();

        $this->Request = "user/add";
    }

}