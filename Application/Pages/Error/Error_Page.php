<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 04/01/2017
 * Time: 02:11
 */

namespace Application\Pages\Error;

use Application\Pages\Error\Routes\Error404_Route;
use Untitled\PageBuilder\Page;

class Error_Page extends Page
{

    public function __construct(){
        parent::__construct();

        $this->AddRoute(new Error404_Route());
    }

}