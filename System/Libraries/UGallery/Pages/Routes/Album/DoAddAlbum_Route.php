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
use System\Libraries\UWebAdmin\Models\Users\User;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use System\Libraries\UWebAdmin\UWA;
use Untitled\Libraries\Session\Session;
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
        $this->DataProcess = new Gallery_DataProcess();
    }

    public function RunDataProcess()
    {
        $album = $this->DataProcess->AddAlbum();
        if($album != false){
            $this->ViewData['result'] = true;
            $this->ViewData['album'] = $album;
            $Me = new User(Session::Get("user")['Id']);
            UWA::NewActivity($Me, $Me->Name." added album ".$album->Name.".", time());
        }
    }


}