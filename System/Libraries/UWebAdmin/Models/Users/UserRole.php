<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 07/01/2017
 * Time: 01:24
 */

namespace System\Libraries\UWebAdmin\Models\Users;


use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Models\Interfaces\IDeletable;
use System\Libraries\UWebAdmin\Models\Interfaces\IObjArray;
use System\Libraries\UWebAdmin\Models\Interfaces\ISaveable;
use Untitled\Database\Database;

class UserRole implements ISaveable, IDeletable, IObjArray
{

    //region Properties
    /**
     * @var int Id
     */
    public $Id;

    /**
     * @var int User Id
     */
    public $UserId;

    /**
     * @var Role The user's role
     */
    public $Role;

    //endregion

    //region Constructors

    /**
     * UserRole constructor.
     * @param $id int User id
     */
    public function __construct($id = null)
    {
        if(!is_null($id)) {
            $this->UserId = $id;

            $db = new Database();
            $db->Connect();

            $db->Run("SELECT * FROM " . UWA_Config::$USER_ROLES_TABLE . " WHERE user_id = :id", [":id" => $this->UserId]);
            $role = $db->Fetch(\PDO::FETCH_ASSOC);

            $this->Role = new Role($role['role_id']);
            $this->Id = $role['id'];
        }
    }

    //endregion

    //region ISaveable, IDeletable, IObjArray Methods
    /**
     * Save any changes to the database
     */
    public function Save()
    {
        $db = new Database();
        $db->Connect();

        $db->Run("UPDATE ". UWA_Config::$USER_ROLES_TABLE ." SET role_id = :r_id WHERE id = :id",
            [":r_id" => $this->Role->Id, ":id" => $this->Id]);
    }

    public function Insert(){
        $db = new Database();
        $db->Connect();

        $db->Run("INSERT INTO ". UWA_Config::$USER_ROLES_TABLE ."(user_id, role_id) VALUES(:userid, :role)",
            [":userid" => $this->UserId, ":role" => $this->Role->Id]);
    }

    /**
     * Delete record from the database
     */
    public function Delete(){
        $db = new Database();
        $db->Connect();

        $db->Run("DELETE FROM ". UWA_Config::$USER_ROLES_TABLE ." WHERE id = :id", [":id" => $this->Id]);
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