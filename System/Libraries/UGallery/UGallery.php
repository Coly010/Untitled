<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 19:58
 */

namespace System\Libraries\UGallery;


use System\Libraries\Interfaces\IPlugin;
use System\Libraries\UGallery\Config\UGallery_RouteStrings;
use System\Libraries\UGallery\Models\Api\Api;
use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Models\Dashboard\MenuItem;

class UGallery extends Api implements IPlugin
{

    public static $MIME_TYPES = ['jpeg' => 'image/jpeg', 'jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif',
    'tiff' => 'image/tiff', 'tif' => 'image/tiff', 'bmp' => 'image/bmp', 'txt' => 'text/plain', 'text' => 'text/plain',
    'avi' => 'video/avi', 'm2v' => 'video/mpeg', 'mov' => 'video/quicktime', 'mpeg' => 'video/mpeg', 'zip' => 'application/zip', ];

    public static function Start()
    {
        defined("UGALLERY_PHOTO") OR define("UGALLERY_PHOTO", 1);
        defined("UGALLERY_VIDEO") OR define("UGALLERY_VIDEO", 2);

        defined("UPLOAD_SIZE") OR define("UPLOAD_SIZE", 2200000);

        self::AddMenuLink();
    }

    public static function AddMenuLink(){
        UWA_Config::$MENU_LINKS[] = new MenuItem("Gallery Settings", null, true);
        UWA_Config::$MENU_LINKS[] = new MenuItem("Add Album", DIRECTORY_SEPARATOR.UGallery_RouteStrings::$ADD_ALBUM);
        UWA_Config::$MENU_LINKS[] = new MenuItem("Edit Album", DIRECTORY_SEPARATOR.UGallery_RouteStrings::$EDIT_ALBUM);
        UWA_Config::$MENU_LINKS[] = new MenuItem("View Album", DIRECTORY_SEPARATOR.UGallery_RouteStrings::$VIEW_ALBUM);
        UWA_Config::$MENU_LINKS[] = new MenuItem("Delete Album", DIRECTORY_SEPARATOR.UGallery_RouteStrings::$DELETE_ALBUM);

        UWA_Config::$MENU_LINKS[] = new MenuItem("Upload Media", DIRECTORY_SEPARATOR.UGallery_RouteStrings::$UPLOAD_MEDIA);
        UWA_Config::$MENU_LINKS[] = new MenuItem("Add Media to Album", DIRECTORY_SEPARATOR.UGallery_RouteStrings::$ADD_MEDIA_ALBUM);

    }


}