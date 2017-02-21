<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 21/02/2017
 * Time: 04:58
 */

namespace System\Libraries\UCarousel\Pages\Dashboard\Routes\CarouselItem;


use System\Libraries\UCarousel\Config\UCarousel_RouteStrings;
use System\Libraries\UCarousel\DataProcesses\UCarousel_DataProcess;
use Untitled\PageBuilder\Route;

class DeleteItem_Route extends Route
{

    /**
     * AddItem_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UCarousel_RouteStrings::$DELETE_CAROUSEL_ITEM;
        $this->DataProcess = new UCarousel_DataProcess();
        $this->RenderView = true;
        $this->ViewFilePath = "Dashboard/CarouselItem/delete.html";
        $this->ViewData['page_name'] = "Delete Carousel Item";
    }

    public function RunDataProcess()
    {
        // TODO: Implement RunDataProcess() method.
    }


}