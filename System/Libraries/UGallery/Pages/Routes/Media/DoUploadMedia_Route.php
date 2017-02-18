<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 21:26
 */

namespace System\Libraries\UGallery\Pages\Routes\Media;


use System\Libraries\UGallery\Config\UGallery_RouteStrings;
use System\Libraries\UGallery\DataProcesses\Gallery_DataProcess;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
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
        $this->RouteGuard = new AuthenticatedUser_Guard();
        $this->DataProcess = new Gallery_DataProcess();
    }

    public function RunDataProcess()
    {
        $this->DataProcess->UploadMedia();
    }


}