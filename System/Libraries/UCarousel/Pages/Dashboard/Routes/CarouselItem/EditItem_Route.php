<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 21/02/2017
 * Time: 04:57
 */

namespace System\Libraries\UCarousel\Pages\Dashboard\Routes\CarouselItem;


use System\Libraries\UBlog\UBlog;
use System\Libraries\UCarousel\Config\UCarousel_RouteStrings;
use System\Libraries\UCarousel\DataProcesses\UCarousel_DataProcess;
use System\Libraries\UCarousel\Models\Carousel\Carousel;
use System\Libraries\UCarousel\UCarousel;
use System\Libraries\UGallery\UGallery;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\PageBuilder\Route;

class EditItem_Route extends Route
{

    /**
     * AddItem_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UCarousel_RouteStrings::$EDIT_CAROUSEL_ITEM;
        $this->DataProcess = new UCarousel_DataProcess();
        $this->RenderView = true;
        $this->ComplexRoute = true;
        $this->ViewFilePath = "Dashboard/CarouselItem/edit.html";
        $this->ViewData['page_name'] = "Edit Carousel Item";
        $this->RouteGuard = new AuthenticatedUser_Guard();
    }

    public function RunDataProcess()
    {
        $this->ViewData['all_posts'] = UBlog::GetPosts();
        $this->ViewData['media'] = UGallery::GetAllMedia();
        $this->ViewData['all_carousel_items'] = UCarousel::GetCarouselItems($this->Params[0]);
        $this->ViewData['carousel'] = new Carousel($this->Params[0], false);
    }


}