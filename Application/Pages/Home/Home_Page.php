<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 03/01/2017
 * Time: 03:19
 */

namespace Application\Pages\Home;

use Application\Pages\Home\Routes\Homepage_Route;
use Application\Pages\Home\Routes\HomepageComplex_Route;
use Untitled\PageBuilder\Page;


class Home_Page extends Page
{

    public function __construct(){
        parent::__construct();

        $this->AddRoute(new Homepage_Route());
        $this->AddRoute(new HomepageComplex_Route());
    }

}