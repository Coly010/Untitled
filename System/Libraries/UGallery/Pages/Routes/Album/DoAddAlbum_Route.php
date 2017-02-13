<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 21:21
 */

namespace System\Libraries\UGallery\Pages\Routes\Album;


use System\Libraries\UGallery\Config\UGallery_RouteStrings;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\PageBuilder\Route;

class DoAddAlbum_Route extends Route
{


    /**
     * DoAddAlbum_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UGallery_RouteStrings::$ADD_ALBUM. "/do";
        $this->RenderView = true;
        $this->RouteGuard = new AuthenticatedUser_Guard();
        $this->ViewFilePath = "UGallery/Dashboard/Album/add.html";
        $this->ViewData['page_name'] = "Add Album";
    }

    public function RunDataProcess()
    {
        // TODO: Implement RunDataProcess() method.
    }


}