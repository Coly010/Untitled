<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 21:22
 */

namespace System\Libraries\UGallery\Pages\Routes\Album;


use System\Libraries\UGallery\Config\UGallery_RouteStrings;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\PageBuilder\Route;

class DoDeleteAlbum_Route extends Route
{


    /**
     * DoDeleteAlbum_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UGallery_RouteStrings::$DELETE_ALBUM."/do";
        $this->RenderView = true;
        $this->RouteGuard = new AuthenticatedUser_Guard();
        $this->ViewFilePath = "UGallery/Dashboard/Album/delete.html";
        $this->ViewData['page_name'] = "Delete Album";
    }

    public function RunDataProcess()
    {
        // TODO: Implement RunDataProcess() method.
    }


}