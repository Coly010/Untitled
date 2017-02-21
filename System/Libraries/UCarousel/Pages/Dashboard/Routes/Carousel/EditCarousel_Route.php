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
use Untitled\PageBuilder\Route;

class EditCarousel_Route extends Route
{

    /**
     * EditCarousel_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UCarousel_RouteStrings::$EDIT_CAROUSEL;
        $this->DataProcess = new UCarousel_DataProcess();
        $this->RenderView = true;
        $this->ViewFilePath = "Dashboard/Carousel/edit.html";
        $this->ViewData['page_name'] = "Edit Carousel";
    }

    public function RunDataProcess()
    {

    }


}