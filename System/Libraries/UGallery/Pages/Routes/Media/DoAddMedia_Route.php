<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 21:26
 */

namespace System\Libraries\UGallery\Pages\Routes\Media;


use System\Libraries\UGallery\Config\UGallery_RouteStrings;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\PageBuilder\Route;

class DoAddMedia_Route extends Route
{

    /**
     * DoAddMedia_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UGallery_RouteStrings::$ADD_MEDIA_ALBUM."/do";
        $this->RouteGuard = new AuthenticatedUser_Guard();
    }

    public function RunDataProcess()
    {
        // TODO: Implement RunDataProcess() method.
    }


}