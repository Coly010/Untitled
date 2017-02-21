<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 21/02/2017
 * Time: 05:03
 */

namespace System\Libraries\UCarousel\Pages\Dashboard\Routes\Carousel;


use System\Libraries\UCarousel\Config\UCarousel_RouteStrings;
use System\Libraries\UCarousel\DataProcesses\UCarousel_DataProcess;
use Untitled\PageBuilder\Route;

class GetCarousel_Route extends Route
{

    /**
     * GetCarousel_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UCarousel_RouteStrings::$GET_CAROUSEL;
        $this->DataProcess = new UCarousel_DataProcess();
        $this->RenderView = false;
    }

    public function RunDataProcess()
    {
    }


}