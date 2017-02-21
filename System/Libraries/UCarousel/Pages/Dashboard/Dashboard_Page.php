<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 21/02/2017
 * Time: 04:50
 */

namespace System\Libraries\UCarousel\Pages\Dashboard;


use System\Libraries\UCarousel\Pages\Dashboard\Routes\Carousel\AddCarousel_Route;
use System\Libraries\UCarousel\Pages\Dashboard\Routes\Carousel\DeleteCarousel_Route;
use System\Libraries\UCarousel\Pages\Dashboard\Routes\Carousel\DoAddCarouel_Route;
use System\Libraries\UCarousel\Pages\Dashboard\Routes\Carousel\DoDeleteCarousel_Route;
use System\Libraries\UCarousel\Pages\Dashboard\Routes\Carousel\DoEditCarousel_Route;
use System\Libraries\UCarousel\Pages\Dashboard\Routes\Carousel\EditCarousel_Route;
use System\Libraries\UCarousel\Pages\Dashboard\Routes\Carousel\GetCarousel_Route;
use System\Libraries\UCarousel\Pages\Dashboard\Routes\CarouselItem\AddItem_Route;
use System\Libraries\UCarousel\Pages\Dashboard\Routes\CarouselItem\DeleteItem_Route;
use System\Libraries\UCarousel\Pages\Dashboard\Routes\CarouselItem\DoAddItem_Route;
use System\Libraries\UCarousel\Pages\Dashboard\Routes\CarouselItem\DoDeleteItem_Route;
use System\Libraries\UCarousel\Pages\Dashboard\Routes\CarouselItem\DoEditItem_Route;
use System\Libraries\UCarousel\Pages\Dashboard\Routes\CarouselItem\EditItem_Route;
use System\Libraries\UCarousel\Pages\Dashboard\Routes\CarouselItem\GetItem_Route;
use Untitled\PageBuilder\Page;

class Dashboard_Page extends Page
{

    /**
     * Dashboard_Page constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // Carousel Routes

        $this->AddRoute(new AddCarousel_Route());
        $this->AddRoute(new DoAddCarouel_Route());
        $this->AddRoute(new EditCarousel_Route());
        $this->AddRoute(new DoEditCarousel_Route());
        $this->AddRoute(new DeleteCarousel_Route());
        $this->AddRoute(new DoDeleteCarousel_Route());
        $this->AddRoute(new GetCarousel_Route());


        // Carousel Item Routes

        $this->AddRoute(new AddItem_Route());
        $this->AddRoute(new DoAddItem_Route());
        $this->AddRoute(new EditItem_Route());
        $this->AddRoute(new DoEditItem_Route());
        $this->AddRoute(new DeleteItem_Route());
        $this->AddRoute(new DoDeleteItem_Route());
        $this->AddRoute(new GetItem_Route());
    }
}