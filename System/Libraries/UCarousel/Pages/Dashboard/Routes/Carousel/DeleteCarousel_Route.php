<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 21/02/2017
 * Time: 04:56
 */

namespace System\Libraries\UCarousel\Pages\Dashboard\Routes\Carousel;


use System\Libraries\UCarousel\Config\UCarousel_RouteStrings;
use System\Libraries\UCarousel\DataProcesses\UCarousel_DataProcess;
use System\Libraries\UCarousel\UCarousel;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\PageBuilder\Route;

class DeleteCarousel_Route extends Route
{

    /**
     * DeleteCarousel_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UCarousel_RouteStrings::$DELETE_CAROUSEL;
        $this->DataProcess = new UCarousel_DataProcess();
        $this->RenderView = true;
        $this->ViewFilePath = "Dashboard/Carousel/delete.html";
        $this->ViewData['page_name'] = "Delete Carousel";
        $this->RouteGuard = new AuthenticatedUser_Guard();
    }

    public function RunDataProcess()
    {
        $this->ViewData['all_carousels'] = UCarousel::GetAllCarousels();
    }


}