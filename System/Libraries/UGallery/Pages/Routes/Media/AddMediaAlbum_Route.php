<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 21:26
 */

namespace System\Libraries\UGallery\Pages\Routes\Media;


use System\Libraries\UGallery\Config\UGallery_RouteStrings;
use System\Libraries\UGallery\UGallery;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\PageBuilder\Route;

class AddMediaAlbum_Route extends Route
{


    /**
     * AddMediaAlbum_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UGallery_RouteStrings::$ADD_MEDIA_ALBUM;
        $this->RouteGuard = new AuthenticatedUser_Guard();
        $this->RenderView = true;
        $this->ViewFilePath = "UGallery/Dashboard/Media/add.html";
        $this->ViewData['page_name'] = "Add Media to Album";
    }

    public function RunDataProcess()
    {
        $this->ViewData['albums'] = UGallery::GetAllAlbumsWithoutMedia();
        $this->ViewData['media'] = UGallery::GetAllMedia();
    }


}