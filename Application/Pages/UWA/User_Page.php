<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 05/02/2017
 * Time: 15:10
 */

namespace Application\Pages\UWA;


use Application\Pages\UWA\Routes\Users\AddUser_Route;
use Untitled\PageBuilder\Page;

class User_Page extends Page
{

    public function __construct()
    {
        parent::__construct();

        $this->AddRoute(new AddUser_Route());
    }

}