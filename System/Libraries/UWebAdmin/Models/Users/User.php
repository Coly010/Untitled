<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 07/01/2017
 * Time: 01:05
 */

namespace System\Libraries\UWebAdmin\Models\Users;


use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Models\Interfaces\IDeletable;
use System\Libraries\UWebAdmin\Models\Interfaces\IObjArray;
use System\Libraries\UWebAdmin\Models\Interfaces\ISaveable;
use Untitled\Database\Database;

class User implements ISaveable, IDeletable, IObjArray
{

    //region Properties

    /**
     * @var int User's ID
     */
    public $Id;

    /**
     * @var string User's name
     */
    public $Name;

    /**
     * @var string User's username
     */
    public $Username;

    /**
     * @var string User's password - NOTE:: STORE IT ENCRYPTED!
     */
    public $Password;

    /**
     * @var string User's email
     */
    public $Email;

    /**
     * @var UserPhoneNumber User's Phone Number
     */
    public $PhoneNumber;

    /**
     * @var UserAddress User's Address
     */
    public $Address;

    /**
     * @var UserRole User's role
     */
    public $Role;

    /**
     * @var string User's IP
     */
    public $Ip;

    /**
     * @var string Timestamp of user's last action
     */
    public $LastAction;

    /**
     * @var string The name that will appear on the site for the user
     */
    public $DisplayName;

    /**
     * @var string URL to the user's display picture
     */
    public $DisplayPic;

    //endregion

    //region Constructors

    /**
     * User constructor.
     * @param $id int User's Id
     */
    public function __construct($id = null)
    {
        if(!is_null($id)) {
            $this->Id = $id;

            $db = new Database();
            $db->Connect();

            $db->Run("SELECT * FROM " . UWA_Config::$USERS_TABLE . " WHERE id = :id", [":id" => $this->Id]);
            $user = $db->Fetch(\PDO::FETCH_ASSOC);

            $this->Name = $user['name'];
            $this->Username = $user['username'];
            $this->Password = $user['password'];
            $this->Email = $user['email'];
            $this->PhoneNumber = new UserPhoneNumber($this->Id);
            $this->Address = new UserAddress($this->Id);
            $this->Role = new UserRole($this->Id);
            $this->Ip = $_SERVER['REMOTE_ADDR'];
            $this->LastAction = $user['last_action'];
            $this->DisplayName = $user['display_name'];
            $this->DisplayPic = $user['display_pic'];
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

        $db->Run("UPDATE ". UWA_Config::$USERS_TABLE ." SET 
            name = :name,
            username = :username,
            password = :password,
            email = :email,
            ip = :ip,
            last_action = :last_action,
            display_name = :display_name,
            display_pic = :display_pic
            WHERE id = :id",
            [":name" => $this->Name,
            ":username" => $this->Username,
            ":password" => $this->Password,
            ":email" => $this->Email,
            ":ip" => $this->Ip,
            ":last_action" => $this->LastAction,
            ":display_name" => $this->DisplayName,
            ":display_pic" => $this->DisplayPic,
            ":id" => $this->Id]);

        $this->PhoneNumber->Save();
        $this->Address->Save();
        $this->Role->Save();
    }

    /**
     * Insert a new record into the database
     */
    public function Insert()
    {
        $db = new Database();
        $db->Connect();

        $db->Run("INSERT INTO ". UWA_Config::$USERS_TABLE ."( 
             name, username, password, email, ip, last_action, display_name, display_pic)
            VALUES(:uname, :username, :password, :email, :ip, :last_action, :display_name, :display_pic)",
            [":uname" => $this->Name,
                ":username" => $this->Username,
                ":password" => $this->Password,
                ":email" => $this->Email,
                ":ip" => $this->Ip,
                ":last_action" => $this->LastAction,
                ":display_name" => $this->DisplayName,
                ":display_pic" => $this->DisplayPic]);

        $this->Id = $db->InsertId();

        $this->Address->UserId = $this->Id;
        $this->Role->UserId = $this->Id;
        $this->PhoneNumber->UserId = $this->Id;

        $this->PhoneNumber->Insert();
        $this->Address->Insert();
        $this->Role->Insert();
    }

    /**
     * Delete record from the database
     */
    public function Delete(){
        $db = new Database();
        $db->Connect();

        $this->PhoneNumber->Delete();
        $this->Address->Delete();
        $this->Role->Delete();

        $db->Run("DELETE FROM ". UWA_Config::$USERS_TABLE ." WHERE id = :id", [":id" => $this->Id]);
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