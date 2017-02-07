<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 26/01/2017
 * Time: 14:51
 */

namespace System\Libraries\UWebAdmin\Pages\Register;


use System\Libraries\UWebAdmin\Pages\Register\Routes\DoRegister_Route;
use System\Libraries\UWebAdmin\Pages\Register\Routes\RegisterHome_Route;
use Untitled\PageBuilder\Page;

class Register_Page extends Page
{

    public function __construct()
    {
        parent::__construct();

        $this->AddRoute(new RegisterHome_Route());
        $this->AddRoute(new DoRegister_Route());
    }

}