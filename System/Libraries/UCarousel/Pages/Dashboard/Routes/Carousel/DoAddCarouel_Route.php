<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 21/02/2017
 * Time: 04:55
 */

namespace System\Libraries\UCarousel\Pages\Dashboard\Routes\Carousel;


use System\Libraries\UCarousel\Config\UCarousel_RouteStrings;
use System\Libraries\UCarousel\DataProcesses\UCarousel_DataProcess;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\PageBuilder\Route;

class DoAddCarouel_Route extends Route
{

    /**
     * DoAddCarouel_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UCarousel_RouteStrings::$ADD_CAROUSEL."/do";
        $this->DataProcess = new UCarousel_DataProcess();
        $this->RenderView = true;
        $this->ViewFilePath = "Dashboard/Carousel/add.html";
        $this->ViewData['page_name'] = "Add Carousel";
        $this->RouteGuard = new AuthenticatedUser_Guard();
    }

    public function RunDataProcess()
    {
        $result = $this->DataProcess->AddCarousel();
        if($result != false){
            $this->ViewData['result'] = true;
            $this->ViewData['carousel'] = $result;
        } else {
            $this->ViewData['result'] = false;
        }

    }


}