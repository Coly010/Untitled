<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 21/02/2017
 * Time: 17:09
 */

namespace System\Libraries\UCarousel\Pages;


use System\Libraries\UCarousel\Pages\Routes\Example_Route;
use Untitled\PageBuilder\Page;

class Carousel_Page extends Page
{

    public function __construct()
    {
        parent::__construct();

        $this->AddRoute(new Example_Route());
    }

}