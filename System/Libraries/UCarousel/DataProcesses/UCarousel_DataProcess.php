<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 21/02/2017
 * Time: 04:14
 */

namespace System\Libraries\UCarousel\DataProcesses;


use System\Libraries\UBlog\Models\Blogs\Post;
use System\Libraries\UCarousel\Models\Carousel\Carousel;
use System\Libraries\UCarousel\Models\Carousel\CarouselItem;
use System\Libraries\UGallery\Models\Gallery\Media;
use System\Libraries\UWebAdmin\Models\Users\User;
use Untitled\Libraries\Input\Input;
use Untitled\Libraries\Input\Sanitiser\Sanitiser;
use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\DataProcess;

class UCarousel_DataProcess extends DataProcess
{

    //region Carousel Actions

    /**
     * @param Carousel $carousel
     * @return bool|Carousel item
     */
    public function AddCarousel($carousel = null){
        if(is_null($carousel)){

            $carousel = new Carousel();
            if(false == $carousel->Name = Sanitiser::String(Input::Post("name"))){
                return false;
            }
            
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

            $carousel = new Carousel(Sanitiser::Int(Input::Post("ID")));
            if(false == $carousel->Name = Sanitiser::String(Input::Post("carousel_name"))){
                return false;
            }

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

            $carousel = new Carousel(Sanitiser::Int(Input::Post("carousel")));

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
    public function AddCarouselItem($item = null, $carousel = null){
        if(is_null($item)){

            $item = new CarouselItem();

            $item->Carousel = new Carousel($carousel);
            $item->Header = Sanitiser::String(Input::Post("header"));
            $item->Description = Sanitiser::String(Input::Post("desc"));
            $item->BlogPost = Input::Post("selected-post") != -1 ? new Post(Sanitiser::Int(Input::Post("selected-post"))) : null;
            $item->Media = Input::Post("selected_media") > 0 ? new Media(Sanitiser::Int(Input::Post("selected_media"))) : null;
            $item->User = new User(Session::Get("user")["Id"]);
            $item->Time = time();
        }

        $item->Insert();

        return $item;
    }

    /**
     * @param CarouselItem $item
     * @return CarouselItem
     */
    public function EditCarouselItem($item = null, $carousel = null){
        if(is_null($item)){

            $item = new CarouselItem(Sanitiser::Int(Input::Post("ID")));

            $item->Carousel = new Carousel($carousel);
            $item->Header = Sanitiser::String(Input::Post("header"));
            $item->Description = Sanitiser::String(Input::Post("desc"));
            $item->BlogPost =
                Input::Post("selected-post") != -1 ? new Post(Sanitiser::Int(Input::Post("selected-post"))) : $item->BlogPost;
            $item->Media =
                Input::Post("selected_media") > 0 ? new Media(Sanitiser::Int(Input::Post("selected_media"))) : $item->Media;
            $item->User = new User(Session::Get("user")["Id"]);
            $item->Time = time();
        }

        $item->Save();

        return $item;
    }

    /**
     * @param CarouselItem $item
     * @return CarouselItem
     */
    public function DeleteCarouselItem($item = null){
        if(is_null($item)){

            $item = new CarouselItem(Sanitiser::Int(Input::Post("item")));

        }

        $item->Delete();

        return $item;
    }

    //endregion
}