<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 21/02/2017
 * Time: 04:57
 */

namespace System\Libraries\UCarousel\Pages\Dashboard\Routes\CarouselItem;


use System\Libraries\UCarousel\Config\UCarousel_RouteStrings;
use System\Libraries\UCarousel\DataProcesses\UCarousel_DataProcess;
use System\Libraries\UCarousel\Models\Carousel\Carousel;
use System\Libraries\UGallery\UGallery;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\Route;

class DoAddItem_Route extends Route
{

    /**
     * AddItem_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UCarousel_RouteStrings::$ADD_CAROUSEL_ITEM."/do";
        $this->DataProcess = new UCarousel_DataProcess();
        $this->RenderView = true;
        $this->ComplexRoute = true;
        $this->ViewFilePath = "Dashboard/CarouselItem/add.html";
        $this->ViewData['page_name'] = "Add Carousel Item";
        $this->RouteGuard = new AuthenticatedUser_Guard();
    }

    public function RunDataProcess()
    {
        $result = $this->DataProcess->AddCarouselItem(null, $this->Params[0]);
        if($result != false){
            $this->ViewData['result'] = true;
            $this->ViewData['item'] = $result;
        } else {
            $this->ViewData['result'] = false;
        }

        $this->ViewData['media'] = UGallery::GetAllMedia();
        $this->ViewData['carousel'] = new Carousel($this->Params[0], false);
    }


}