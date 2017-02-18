<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 19:58
 */

namespace System\Libraries\UGallery\Models\Api;


use System\Libraries\UGallery\Config\UGallery_Config;
use System\Libraries\UGallery\Models\Gallery\Album;
use System\Libraries\UGallery\Models\Gallery\Media;
use Untitled\Database\Database;

class Api
{

    //region Albums

    /**
     * @return array albums array with media
     */
    public static function GetAllAlbums(){
        $db = new Database(true);

        $db->Run("SELECT id FROM ". UGallery_Config::$ALBUMS_TABLE, []);

        $Albums = [];
        if($db->NumRows()){
            foreach($db->FetchAll(\PDO::FETCH_ASSOC) as $album){
                $Albums[] = new Album($album['id']);
            }
        }

        return $Albums;
    }

    /**
     * @return array albums array without media
     */
    public static function GetAllAlbumsWithoutMedia(){
        $db = new Database(true);

        $db->Run("SELECT id FROM ". UGallery_Config::$ALBUMS_TABLE, []);

        $Albums = null;
        if($db->NumRows()){
            $Albums = [];
            foreach($db->FetchAll(\PDO::FETCH_ASSOC) as $album){
                $Albums[] = new Album($album['id'], false);
            }
        }

        return $Albums;
    }

    //endregion

    //region Media

    /**
     * @return array|null Media
     */
    public static function GetAllMedia(){
        $db = new Database(true);

        $db->Run("SELECT id FROM ". UGallery_Config::$MEDIA_TABLE, []);

        $Media = null;
        if($db->NumRows()){
            $Media = [];
            foreach($db->FetchAll(\PDO::FETCH_ASSOC) as $media){
                $Media[] = new Media($media['id']);
            }
        }

        return $Media;
    }

    //endregion

}