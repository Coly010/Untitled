<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 19:59
 */

namespace System\Libraries\UGallery\Models\Gallery;


use System\Libraries\UGallery\Config\UGallery_Config;
use System\Libraries\UWebAdmin\Models\Interfaces\IDeletable;
use System\Libraries\UWebAdmin\Models\Interfaces\IObjArray;
use System\Libraries\UWebAdmin\Models\Interfaces\ISaveable;
use System\Libraries\UWebAdmin\Models\Users\User;
use Untitled\Database\Database;

class Album implements IObjArray, IDeletable, ISaveable
{

    //region Properties

    /**
     * @var number Id of the album
     */
    public $Id;

    /**
     * @var string Name of the album
     */
    public $Name;

    /**
     * @var string description of the album
     */
    public $Description;

    /**
     * @var array Photos in the album
     */
    public $Photos;

    /**
     * @var array Videos in the album
     */
    public $Videos;

    /**
     * @var string Time the album was created
     */
    public $Created;

    /**
     * @var string Time the album was last modified
     */
    public $LastModified;

    /**
     * @var User The user that created the album
     */
    public $User;

    //endregion

    //region Constructors

    /**
     * Album constructor.
     * @param null $id id of the album
     */
    public function __construct($id = null, $media = true)
    {
        if(!is_null($id)){

            $this->Id = $id;

            $db = new Database(true);

            $db->Run("SELECT * FROM ". UGallery_Config::$ALBUMS_TABLE ." id = :id",
                [
                    ":id" => $this->Id
                ]);

            $album = $db->Fetch(\PDO::FETCH_ASSOC);
            $this->Name = $album['name'];
            $this->Description = $album['description'];
            $this->Created = $album['created'];
            $this->LastModified = $album['last_modified'];
            $this->User = new User($album['id']);

            if($media){
                $db->Run("SELECT * FROM ". UGallery_Config::$ALBUM_MEDIA_TABLE ." WHERE album = :album",
                    [
                        ":album" => $this->Id
                    ]);
                if($db->NumRows()){
                    foreach($db->FetchAll(\PDO::FETCH_ASSOC) as $item){
                        if($item == UGALLERY_PHOTO){
                            $this->Photos[] = new Photo($item['media']);
                        } else if($item == UGALLERY_VIDEO) {
                            $this->Videos[] = new Video($item['media']);
                        }
                    }
                }
            }

        }
    }

    //endregion

    //region IObjArray, IDeletable, ISaveable Methods

    /**
     * Delete the album
     */
    public function Delete()
    {
        $db = new Database(true);

        $db->Run("DELETE FROM ". UGallery_Config::$ALBUMS_TABLE ." WHERE id = :id", [":id" => $this->Id]);
        $db->Run("DELETE FROM ". UGallery_Config::$ALBUM_MEDIA_TABLE ." WHERE album = :album", [":album" => $this->Id]);

    }

    /**
     * Save the album
     */
    public function Save()
    {
        $db = new Database(true);

        $db->Run("UPDATE ". UGallery_Config::$ALBUMS_TABLE ." SET 
        name = :name, description = :desc, created = :created, last_modified = :last_modified, user = :user WHERE id = :id",
            [
                ":name" => $this->Name,
                ":desc" => $this->Description,
                ":created" => $this->Created,
                ":last_modified" => $this->LastModified,
                ":user" => $this->User->Id,
                ":id" => $this->Id
            ]);
    }

    /**
     * Insert a new album
     */
    public function Insert()
    {
        $db = new Database(true);

        $db->Run("INSERT INTO ". UGallery_Config::$ALBUMS_TABLE ."(name, description, created, last_modified, user) 
        VALUES(:name, :desc, :created, :last_modified, :user)",
            [
                ":name" => $this->Name,
                ":desc" => $this->Description,
                ":created" => $this->Created,
                ":last_modified" => $this->LastModified,
                ":user" => $this->User->Id,
            ]);

        $this->Id = $db->InsertId();
    }

    /**
     * @return array object as array
     */
    public function ToArray()
    {
        return get_object_vars($this);
    }

    //endregion


}