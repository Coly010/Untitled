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
use System\Libraries\UGallery\UGallery;
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

    /**
     * @param $media - media to check
     * @return bool - result
     */
    public static function CheckMediaExists($media){
        $db = new Database(true);

        $db->Run("SELECT id FROM ". UGallery_Config::$MEDIA_TABLE ." WHERE id = :id", [":id" => $media]);

        return $db->NumRows() > 0 ? true : false;
    }

    /**
     * @param $album - album id to add the media too
     * @param $media - the media id to add
     * @param null $db - database object
     * @return int - insert id
     */
    public static function AddMediaToAlbum($album, $media, $db = null){
        if(is_null($db)){
            $db = new Database(true);
        }

        $db->Run("INSERT INTO ". UGallery_Config::$ALBUM_MEDIA_TABLE ."(album, media) VALUES(:album, :media)",
            [
                ":album" => $album,
                ":media" => $media
            ]);

        return $db->InsertId();
    }

    //endregion

}