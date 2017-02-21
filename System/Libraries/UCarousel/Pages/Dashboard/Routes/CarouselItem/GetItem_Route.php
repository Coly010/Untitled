<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 21/02/2017
 * Time: 05:05
 */

namespace System\Libraries\UCarousel\Pages\Dashboard\Routes\CarouselItem;


use System\Libraries\UCarousel\Config\UCarousel_RouteStrings;
use System\Libraries\UCarousel\DataProcesses\UCarousel_DataProcess;
use System\Libraries\UCarousel\Models\Carousel\CarouselItem;
use Untitled\Libraries\Input\Input;
use Untitled\Libraries\Input\Sanitiser\Sanitiser;
use Untitled\PageBuilder\Route;

class GetItem_Route extends Route
{

    /**
     * AddItem_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UCarousel_RouteStrings::$GET_CAROUSEL_ITEM;
        $this->DataProcess = new UCarousel_DataProcess();
        $this->ComplexRoute = true;
        $this->RenderView = false;
    }

    public function RunDataProcess()
    {
        $this->ViewData['item'] = new CarouselItem(Sanitiser::Int(Input::Post("item_id")));
    }


}