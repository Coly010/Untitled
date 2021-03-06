<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 07/01/2017
 * Time: 01:25
 */

namespace System\Libraries\UWebAdmin\Models\Users;


use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Models\Interfaces\IDeletable;
use System\Libraries\UWebAdmin\Models\Interfaces\IObjArray;
use System\Libraries\UWebAdmin\Models\Interfaces\ISaveable;
use Untitled\Database\Database;

class UserPhoneNumber implements ISaveable, IDeletable, IObjArray
{

    //region Properties

    /**
     * @var number Id - Id of the phone number
     */
    public $Id;

    /**
     * @var number UserId - Id of the user
     */
    public $UserId;

    /**
     * @var string Number - Phone Number
     */
    public $Number;

    //endregion

    //region Constructors

    /**
     * UserPhoneNumber constructor.
     * @param number $id - Id of phone number
     */
    public function __construct($id = null)
    {
        if(!is_null($id)){
            $this->UserId = $id;

            $db = new Database();
            $db->Connect();

            $db->Run("SELECT * FROM ". UWA_Config::$USER_PHONE_NUMBERS_TABLE ." WHERE user_id = :id", [":id" => $this->UserId]);
            $number = $db->Fetch(\PDO::FETCH_ASSOC);

            $this->Id = $number['id'];
            $this->Number = $number['phone_number'];
        }
    }

    //endregion

    //region ISaveable, IDeletable, IObjArray Methods

    /**
     * Save any changes to the database
     */
    public function Save(){
        $db = new Database();
        $db->Connect();

        $db->Run("UPDATE ". UWA_Config::$USER_PHONE_NUMBERS_TABLE ." SET
            user_id = :userid,
            phone_number = :phone_number
            WHERE id = :id",
            [":userid" => $this->UserId,
                ":phone_number" => $this->Number,
                ":id" => $this->Id
            ]);
    }

    /**
     * Insert new record to the database
     */
    public function Insert()
    {
        $db = new Database();
        $db->Connect();

        $db->Run("INSERT INTO ". UWA_Config::$USER_PHONE_NUMBERS_TABLE ."(user_id, phone_number) 
                    VALUES(:userid, :phone_number)",
            [":userid" => $this->UserId, ":phone_number" => $this->Number]);
    }

    /**
     * Delete record from the database
     */
    public function Delete()
    {
        $db = new Database();
        $db->Connect();

        $db->Run("DELETE FROM ". UWA_Config::$USER_PHONE_NUMBERS_TABLE ." WHERE id = :id", [":id" => $this->Id]);
    }

    /**
     * @return array Object as array
     */
    public function ToArray()
    {
        return get_object_vars($this);
    }

    //endregion

}