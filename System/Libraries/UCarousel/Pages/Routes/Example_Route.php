<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 21/02/2017
 * Time: 17:10
 */

namespace System\Libraries\UCarousel\Pages\Routes;


use Untitled\PageBuilder\Route;

class Example_Route extends Route
{

    public function __construct()
    {
        parent::__construct();
        $this->Request = "carousel/example";
        $this->RenderView = true;
        $this->ViewFilePath = "Carousel/carousel.html";
    }

    public function RunDataProcess()
    {
        // TODO: Implement RunDataProcess() method.
    }


}