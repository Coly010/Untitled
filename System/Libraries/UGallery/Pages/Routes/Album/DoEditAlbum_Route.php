<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 21:21
 */

namespace System\Libraries\UGallery\Pages\Routes\Album;


use System\Libraries\UGallery\Config\UGallery_RouteStrings;
use System\Libraries\UGallery\DataProcesses\Gallery_DataProcess;
use System\Libraries\UGallery\UGallery;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\PageBuilder\Route;

class DoEditAlbum_Route extends Route
{


    /**
     * DoEditAlbum_Route constructor.
     */
    public function __construct()
    {
        $this->Request = UGallery_RouteStrings::$EDIT_ALBUM."/do";
        $this->RenderView = true;
        $this->RouteGuard = new AuthenticatedUser_Guard();
        $this->ViewFilePath = "UGallery/Dashboard/Album/edit.html";
        $this->ViewData['page_name'] = "Edit Album";
        $this->DataProcess = new Gallery_DataProcess();
    }

    public function RunDataProcess()
    {
        $album = $this->DataProcess->EditAlbum();
        if($album != false){
            $this->ViewData['result'] = true;
            $this->ViewData['album'] = $album;
        }
        $this->ViewData['all_albums'] = UGallery::GetAllAlbumsWithoutMedia();
    }


}