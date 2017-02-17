<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 21:26
 */

namespace System\Libraries\UGallery\Pages\Routes\Media;


use System\Libraries\UGallery\Config\UGallery_RouteStrings;
use Untitled\Libraries\Input\Input;
use Untitled\PageBuilder\Route;

class DoUploadMedia_Route extends Route
{


    /**
     * DoUploadMedia_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UGallery_RouteStrings::$UPLOAD_MEDIA."/do";
        $this->RenderView = false;
    }

    public function RunDataProcess()
    {
        $files = Input::File("files");
    }


}