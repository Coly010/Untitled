<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 21:20
 */

namespace System\Libraries\UGallery\Pages;


use System\Libraries\UGallery\Pages\Routes\Album\AddAlbum_Route;
use System\Libraries\UGallery\Pages\Routes\Album\DeleteAlbum_Route;
use System\Libraries\UGallery\Pages\Routes\Album\DoAddAlbum_Route;
use System\Libraries\UGallery\Pages\Routes\Album\DoDeleteAlbum_Route;
use System\Libraries\UGallery\Pages\Routes\Album\DoEditAlbum_Route;
use System\Libraries\UGallery\Pages\Routes\Album\EditAlbum_Route;
use System\Libraries\UGallery\Pages\Routes\Album\GetAlbum_Route;
use System\Libraries\UGallery\Pages\Routes\Album\ViewAlbum_Route;
use System\Libraries\UGallery\Pages\Routes\Media\AddMediaAlbum_Route;
use System\Libraries\UGallery\Pages\Routes\Media\DoAddMedia_Route;
use System\Libraries\UGallery\Pages\Routes\Media\DoUploadMedia_Route;
use System\Libraries\UGallery\Pages\Routes\Media\UploadMedia_Route;
use System\Libraries\UGallery\Pages\Routes\Upload\GetUploadProgress_Route;
use Untitled\PageBuilder\Page;

class GalleryDashboard_Page extends Page
{


    /**
     * GalleryDashboard_Page constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->AddRoute(new AddAlbum_Route());
        $this->AddRoute(new DoAddAlbum_Route());
        $this->AddRoute(new EditAlbum_Route());
        $this->AddRoute(new DoEditAlbum_Route());
        $this->AddRoute(new DeleteAlbum_Route());
        $this->AddRoute(new DoDeleteAlbum_Route());
        $this->AddRoute(new ViewAlbum_Route());
        $this->AddRoute(new GetAlbum_Route());

        $this->AddRoute(new AddMediaAlbum_Route());
        $this->AddRoute(new DoAddMedia_Route());
        $this->AddRoute(new UploadMedia_Route());
        $this->AddRoute(new DoUploadMedia_Route());

        $this->AddRoute(new GetUploadProgress_Route());

    }
}