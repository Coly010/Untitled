<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 21:24
 */

namespace System\Libraries\UGallery\Pages\Routes\Media;


use System\Libraries\UGallery\Config\UGallery_RouteStrings;
use System\Libraries\UGallery\UGallery;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
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
        $this->RouteGuard = new AuthenticatedUser_Guard();
    }

    public function RunDataProcess()
    {
        $this->ViewData['albums'] = UGallery::GetAllAlbumsWithoutMedia();
        $this->ViewData['session_progress_name'] = ini_get("session.upload_progress.name");
        $this->ViewData['max_file_size'] = UPLOAD_SIZE;
    }


}