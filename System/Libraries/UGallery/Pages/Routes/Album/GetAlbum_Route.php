<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 21:59
 */

namespace System\Libraries\UGallery\Pages\Routes\Album;


use System\Libraries\UGallery\Config\UGallery_RouteStrings;
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
        // TODO: Implement RunDataProcess() method.
    }


}