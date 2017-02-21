<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 21/02/2017
 * Time: 04:14
 */

namespace System\Libraries\UCarousel\DataProcesses;


use System\Libraries\UCarousel\Models\Carousel\Carousel;
use System\Libraries\UCarousel\Models\Carousel\CarouselItem;
use Untitled\PageBuilder\DataProcess;

class UCarousel_DataProcess extends DataProcess
{

    //region Carousel Actions

    /**
     * @param Carousel $carousel
     * @return Carousel item
     */
    public function AddCarousel($carousel = null){
        if(is_null($carousel)){

        }

        $carousel->Insert();

        return $carousel;
    }

    /**
     * @param Carousel $carousel
     * @return Carousel item
     */
    public function EditCarousel($carousel = null){
        if(is_null($carousel)){

        }

        $carousel->Save();

        return $carousel;
    }

    /**
     * @param Carousel $carousel
     * @return Carousel item
     */
    public function DeleteCarousel($carousel = null){
        if(is_null($carousel)){

        }

        $carousel->Delete();

        return $carousel;
    }

    //endregion

    //region Carousel Item Actions

    /**
     * @param CarouselItem $item
     * @return CarouselItem
     */
    public function AddCarouselItem($item = null){
        if(is_null($item)){

        }

        return $item;
    }

    /**
     * @param CarouselItem $item
     * @return CarouselItem
     */
    public function EditCarouselItem($item = null){
        if(is_null($item)){

        }

        return $item;
    }

    /**
     * @param CarouselItem $item
     * @return CarouselItem
     */
    public function DeleteCarouselItem($item = null){
        if(is_null($item)){

        }

        return $item;
    }

    //endregion
}