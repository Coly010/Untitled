<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 21:59
 */

namespace System\Libraries\UGallery\Pages\Routes\Album;


use System\Libraries\UGallery\Config\UGallery_RouteStrings;
use System\Libraries\UGallery\Models\Gallery\Album;
use Untitled\Libraries\Input\Input;
use Untitled\Libraries\Input\Sanitiser\Sanitiser;
use Untitled\PageBuilder\Route;

class GetAlbum_Route extends Route
{


    /**
     * GetAlbum_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UGallery_RouteStrings::$GET_ALBUM;
        $this->RenderView = false;
    }

    public function RunDataProcess()
    {
        $album = new Album(Sanitiser::Number(Input::Post("album_id")));
        $this->ViewData['found_album'] = $album->ToArray();
    }


}