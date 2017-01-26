<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 07/01/2017
 * Time: 01:25
 */

namespace System\Libraries\UWebAdmin\Models\Users;


use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Models\Interfaces\ISaveable;
use Untitled\Database\Database;

class UserPhoneNumber implements ISaveable
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
            $this->Id = $id;

            $db = new Database();
            $db->Connect();

            $db->Run("SELECT * FROM ". UWA_Config::$USER_PHONE_NUMBERS_TABLE ." WHERE id = :id", [":id" => $this->Id]);
            $number = $db->Fetch(\PDO::FETCH_ASSOC);

            $this->UserId = $number['userid'];
            $this->Number = $number['phone_number'];
        }
    }

    //endregion

    //region ISaveable Methods

    /**
     * Save any changes to the database
     */
    public function Save(){
        $db = new Database();
        $db->Connect();

        $db->Run("UPDATE ". UWA_Config::$USER_PHONE_NUMBERS_TABLE ." SET
            userid = :userid,
            phone_number = :number
            WHERE id = :id",
            [":userid" => $this->UserId,
                ":number" => $this->Number,
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

        $db->Run("INSERT INTO ". UWA_Config::$USER_PHONE_NUMBERS_TABLE ."(userid, phone_number) VALUES(:userid, :number)",
            [":userid" => $this->UserId, ":number" => $this->Number]);
    }

    //endregion

}