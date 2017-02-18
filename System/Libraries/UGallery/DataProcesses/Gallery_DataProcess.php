<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 22:53
 */

namespace System\Libraries\UGallery\DataProcesses;


use System\Libraries\UGallery\Config\UGallery_Config;
use System\Libraries\UGallery\Models\Gallery\Album;
use System\Libraries\UGallery\UGallery;
use System\Libraries\UWebAdmin\Models\Users\User;
use Untitled\Database\Database;
use Untitled\Libraries\Input\Input;
use Untitled\Libraries\Input\Sanitiser\Sanitiser;
use Untitled\Libraries\Input\Sanitiser\Validator;
use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\DataProcess;

class Gallery_DataProcess extends DataProcess
{

    //region Albums

    /**
     * @param Album $album add new album
     * @return Album album being added
     */
    public function AddAlbum($album = null){

        if(is_null($album)){
            $album = new Album();

            $album->Name = Sanitiser::String(Input::Post("name"));
            $album->Description = Sanitiser::String(Input::Post("desc"));
            $album->User = new User(Session::Get("user")['Id']);
            $album->Created = time();
            $album->LastModified = time();
        }

        $album->Insert();

        return $album;
    }

    /**
     * @param Album $album edited album
     * @return Album album being edited
     */
    public function EditAlbum($album = null){

        if(is_null($album)){
            $album = new Album(Sanitiser::Number(Input::Post("ID")), false);

            $album->Name = Sanitiser::String(Input::Post("name"));
            $album->Description = Sanitiser::String(Input::Post("desc"));
            $album->User = new User(Session::Get("user")['Id']);
            $album->LastModified = time();
        }

        $album->Save();

        return $album;
    }

    /**
     * @param Album $album delete album
     * @return Album album being deleted
     */
    public function DeleteAlbum($album = null){

        if(is_null($album)){
            $album = new Album(Session::Get("user")['Id'], false);
        }

        $album->Delete();

        return $album;
    }

    //endregion

    //region Media

    /**
     * Upload media
     */
    public function UploadMedia(){

        $files = Input::File("files");
        $addToAlbum = Sanitiser::Int(Input::Post("addToAlbum"));
        $album = $addToAlbum == 1 ? Sanitiser::Int(Input::Post("album")) : -1;

        $db = new Database(true);

        foreach($files as $file){

            $rel_file = $file;

            if($file[0] != "."){
                if($file[1] != "/"){
                    $rel_file = "./" . $file;
                }
            }

            $type = Validator::IsImage($rel_file) == true ? 1 : 2;

            $db->Run("INSERT INTO ". UGallery_Config::$MEDIA_TABLE ."(type, source, user, time)
            VALUES(:type, :source, :user, :time)",
                [
                    ":type" => $type,
                    ":source" => $file,
                    ":user" => Session::Get("user")['Id'],
                    ":time" => time()
                ]);

            if($album != -1){
                $media = $db->InsertId();
                $db->Run("INSERT INTO ". UGallery_Config::$ALBUM_MEDIA_TABLE ."(album, media) VALUES(:album, :media)",
                    [
                        ":album" => $album,
                        ":media" => $media
                    ]);
            }

        }
    }

    /**
     * @return bool result
     */
    public function AddMediaToAlbum(){

        $album = Sanitiser::Int(Input::Post("album"));
        $selected_media = Input::Post("selected_media");

        $db = new Database(true);

        foreach($selected_media as $media){
            $media = Sanitiser::Int($media);
            if(!UGallery::CheckMediaExists($media)){
                return false;
            }

            UGallery::AddMediaToAlbum($album, $media, $db);

        }

        return true;

    }

    //endregion

}