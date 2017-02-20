<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 20:08
 */

namespace System\Libraries\UGallery\Models\Gallery;


use System\Libraries\UGallery\Config\UGallery_Config;
use System\Libraries\UWebAdmin\Models\Users\User;
use Untitled\Database\Database;

class Media
{
    //region Properties

    /**
     * @var number Id of the media item
     */
    public $Id;

    /**
     * @var number type of the media
     */
    public $Type;

    /**
     * @var string Source of the media item
     */
    public $Source;

    /**
     * @var string Time the media was uploaded
     */
    public $Time;

    /**
     * @var User user that uploaded the media
     */
    public $User;

    //endregion

    //region Constructor

    /**
     * Media constructor.
     * @param $id
     */
    public function __construct($id)
    {
        if(!is_null($id)){

            $this->Id = $id;

            $db = new Database(true);

            $db->Run("SELECT * FROM ". UGallery_Config::$MEDIA_TABLE ." WHERE id = :id",
                [
                    ":id" => $this->Id
                ]);

            $media = $db->Fetch(\PDO::FETCH_ASSOC);
            $this->Type = $media['type'];
            $this->Source = $media['source'];
            $this->User = new User($media['user']);
            $this->Time = $media['time'];
        }
    }

    //endregion

    //region IObjArray, IDeletable, ISaveable methods

    /**
     * Delete the media
     */
    public function Delete()
    {
        $db = new Database(true);

        $db->Run("DELETE FROM ". UGallery_Config::$MEDIA_TABLE. " WHERE id = :id", [":id" => $this->Id]);
    }

    /**
     * Save any changes to the media
     */
    public function Save()
    {
        $db = new Database(true);

        $db->Run("UPDATE ". UGallery_Config::$MEDIA_TABLE ." SET 
        type = :type, source = :source, user = :user, time = :time WHERE id = :id",
            [
                ":type" => $this->Type,
                ":source" => $this->Source,
                ":user" => $this->User->Id,
                ":time" => $this->Time,
                ":id" => $this->Id
            ]);
    }

    /**
     * Insert the media
     */
    public function Insert()
    {
        $db = new Database(true);

        $db->Run("INSERT INTO ". UGallery_Config::$MEDIA_TABLE ."(type, source, user, time) 
        VALUES(:type, :source, :user, :time)",
            [
                ":type" => $this->Type,
                ":source" => $this->Source,
                ":user" => $this->User->Id,
                ":time" => $this->Time
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