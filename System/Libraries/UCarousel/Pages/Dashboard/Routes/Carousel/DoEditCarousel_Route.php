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
use System\Libraries\UWebAdmin\UWA;
use Untitled\PageBuilder\Route;

class DoEditCarousel_Route extends Route
{

    /**
     * DoEditCarousel_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UCarousel_RouteStrings::$EDIT_CAROUSEL."/do";
        $this->DataProcess = new UCarousel_DataProcess();
        $this->RenderView = true;
        $this->ViewFilePath = "Dashboard/Carousel/edit.html";
        $this->ViewData['page_name'] = "Edit Carousel";
        $this->RouteGuard = new AuthenticatedUser_Guard();
    }

    public function RunDataProcess()
    {
        $result = $this->DataProcess->EditCarousel();
        if($result != false){
            $this->ViewData['result'] = true;
            $this->ViewData['carousel'] = $result;
        } else {
            $this->ViewData['result'] = false;
        }

        $this->ViewData['all_carousels'] = UCarousel::GetAllCarousels();

        UWA::ReloadMenu();
    }


}