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
use System\Libraries\UGallery\Models\Gallery\Album;
use System\Libraries\UGallery\UGallery;
use System\Libraries\UWebAdmin\RouteGuards\AuthenticatedUser_Guard;
use Untitled\Libraries\Input\Input;
use Untitled\Libraries\Input\Sanitiser\Sanitiser;
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
        $this->RenderView = true;
        $this->ViewFilePath = "UGallery/Dashboard/Media/add.html";
        $this->ViewData['page_name'] = "Add Media to Album";
        $this->DataProcess = new Gallery_DataProcess();
    }

    public function RunDataProcess()
    {
        $result = $this->DataProcess->AddMediaToAlbum();

        $this->ViewData['result'] = $result;
        $this->ViewData['album'] = new Album(Sanitiser::Int(Input::Post("album")), false);
        $this->ViewData['num_photos'] = $result == true ? count(Input::Post("selected_media")) : 0;

        $this->ViewData['albums'] = UGallery::GetAllAlbumsWithoutMedia();
        $this->ViewData['media'] = UGallery::GetAllMedia();
    }


}