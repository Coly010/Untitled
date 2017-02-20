<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 26/01/2017
 * Time: 12:06
 */

namespace System\Libraries\UWebAdmin\DataProcesses;


use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Models\Users\User;
use System\Libraries\UWebAdmin\Models\Users\UserAddress;
use System\Libraries\UWebAdmin\Models\Users\UserPhoneNumber;
use System\Libraries\UWebAdmin\Models\Users\UserRole;
use System\Libraries\UWebAdmin\Models\Users\Role;
use Untitled\Database\Database;
use Untitled\Libraries\Input\Input;
use Untitled\Libraries\Input\Sanitiser\Sanitiser;
use Untitled\PageBuilder\DataProcess;

class Register_DataProcess extends DataProcess
{

    //region Properties

    /**
     * @var Database Database object
     */
    private $DB;

    //endregion

    //region Constructors

    /**
     * Register_DataProcess constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->DB = new Database();
        $this->DB->Connect();
    }

    //endregion

    //region Register Methods

    /**
     * @param $username string Username
     * @return bool return true or false
     */
    public function CheckUsernameExists($username){
        $this->DB->Run("SELECT * FROM ". UWA_Config::$USERS_TABLE ." WHERE username = :u", [":u" => $username]);
        return $this->DB->NumRows() > 0;
    }

    /**
     * @param $password string
     * @param $cpassword string
     * @return bool return true or false
     */
    public function CheckPasswordsMatch($password, $cpassword){
        return $password == $cpassword;
    }

    /**
     * @return User new uesr
     */
    public function SetupUser(){
        $user = new User();
        $user->Username = Sanitiser::String(Input::Post("username"));
        $user->Password = password_hash(Sanitiser::String(Input::Post("password")), PASSWORD_BCRYPT);
        $user->Email = Sanitiser::Email(Input::Post("email"));
        $user->Ip = "";
        $user->LastAction = "";
        $user->Name = Sanitiser::String(Input::Post("name"));
        $user->DisplayName = $user->Name;
        $user->DisplayPic = "";

        $address = new UserAddress();
        $address->Line1 = Sanitiser::String(Input::Post("line1"));
        $address->Line2 = Sanitiser::String(Input::Post("line2"));
        $address->City = Sanitiser::String(Input::Post("city"));
        $address->Country = Sanitiser::String(Input::Post("country"));
        $address->Zip = Sanitiser::String(Input::Post("zip"));

        $phone = new UserPhoneNumber();
        $phone->Number = Sanitiser::String(Input::Post("phone_number"));

        $role = new UserRole();
        $role->Role = new Role(Sanitiser::Int(Input::Post("role")));

        $user->Address = $address;
        $user->PhoneNumber = $phone;
        $user->Role = $role;

        $user->Insert();
        return $user;
    }

    /**
     * @return bool|User return the registered user or false if it fails
     */
    public function Register(){
        if(empty(Input::Post("username")) && empty(Input::Post("password"))){
            return false;
        }
        if(!$this->CheckUsernameExists(Sanitiser::String(Input::Post("username")))
        && $this->CheckPasswordsMatch(Sanitiser::String(Input::Post("password")), Sanitiser::String(Input::Post("cpassword")))){
            return $this->SetupUser();
        }
        return false;
    }

    //endregion

}