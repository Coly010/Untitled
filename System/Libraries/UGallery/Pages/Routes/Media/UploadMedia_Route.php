<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 21:24
 */

namespace System\Libraries\UGallery\Pages\Routes\Media;


use System\Libraries\UGallery\Config\UGallery_RouteStrings;
use Untitled\PageBuilder\Route;

class UploadMedia_Route extends Route
{


    /**
     * UploadMedia_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UGallery_RouteStrings::$UPLOAD_MEDIA;
        $this->RenderView = true;
        $this->ViewFilePath = "UGallery/Dashboard/Media/upload.html";
        $this->ViewData['page_name'] = "Upload Media";
    }

    public function RunDataProcess()
    {
        $this->ViewData['session_progress_name'] = ini_get("session.upload_progress.name");
        $this->ViewData['max_file_size'] = UPLOAD_SIZE;
    }


}