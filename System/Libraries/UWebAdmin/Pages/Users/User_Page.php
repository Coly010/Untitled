<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 06/02/2017
 * Time: 00:28
 */

namespace System\Libraries\UWebAdmin\Pages\Users;


use System\Libraries\UWebAdmin\Pages\Users\Routes\AddUser_Route;
use System\Libraries\UWebAdmin\Pages\Users\Routes\DeleteUser_Route;
use System\Libraries\UWebAdmin\Pages\Users\Routes\DoAddUser_Route;
use System\Libraries\UWebAdmin\Pages\Users\Routes\DoDeleteUser_Route;
use System\Libraries\UWebAdmin\Pages\Users\Routes\DoEditUser_Route;
use System\Libraries\UWebAdmin\Pages\Users\Routes\EditUser_Route;
use System\Libraries\UWebAdmin\Pages\Users\Routes\GetUser_Route;
use System\Libraries\UWebAdmin\Pages\Users\Routes\MyAccount_Route;
use System\Libraries\UWebAdmin\Pages\Users\Routes\UpdateMyAccount_Route;
use Untitled\PageBuilder\Page;

class User_Page extends Page
{

    public function __construct()
    {
        parent::__construct();

        $this->AddRoute(new AddUser_Route());
        $this->AddRoute(new DoAddUser_Route());
        $this->AddRoute(new EditUser_Route());
        $this->AddRoute(new DoEditUser_Route());
        $this->AddRoute(new DeleteUser_Route());
        $this->AddRoute(new DoDeleteUser_Route());
        $this->AddRoute(new MyAccount_Route());
        $this->AddRoute(new UpdateMyAccount_Route());
        $this->AddRoute(new GetUser_Route());
    }

}