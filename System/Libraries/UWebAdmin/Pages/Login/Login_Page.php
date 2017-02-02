<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 26/01/2017
 * Time: 14:51
 */

namespace System\Libraries\UWebAdmin\Pages\Login;


use System\Libraries\UWebAdmin\Pages\Login\Routes\DoLogin_Route;
use System\Libraries\UWebAdmin\Pages\Login\Routes\LoginHome_Route;
use Untitled\PageBuilder\Page;

class Login_Page extends Page
{

    public function __construct()
    {
        parent::__construct();

        $this->AddRoute(new LoginHome_Route());
        $this->AddRoute(new DoLogin_Route());
    }

}