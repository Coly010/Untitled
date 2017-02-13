<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 22:53
 */

namespace System\Libraries\UGallery\DataProcesses;


use System\Libraries\UGallery\Models\Gallery\Album;
use System\Libraries\UWebAdmin\Models\Users\User;
use Untitled\Libraries\Input\Input;
use Untitled\Libraries\Input\Sanitiser\Sanitiser;
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
            $album->Description = Sanitiser::String(Input::Post("description"));
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
            $album->Description = Sanitiser::String(Input::Post("description"));
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

}