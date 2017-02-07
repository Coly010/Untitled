<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 26/01/2017
 * Time: 12:05
 */

namespace System\Libraries\UWebAdmin\DataProcesses;


use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Models\Users\User;
use Untitled\Database\Database;
use Untitled\Libraries\Input\Input;
use Untitled\Libraries\Input\Sanitiser\Sanitiser;
use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\DataProcess;

class Login_DataProcess extends DataProcess
{

    //region Properties

    /**
     * @var Database Object
     */
    private $DB;

    /**
     * @var User User that is logged in
     */
    private $User;

    //endregion

    //region Constructors

    /**
     * Login_DataProcess constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->DB = new Database();
        $this->DB->Connect();
    }

    //endregion

    //region Login Methods

    /**
     * @param $username string
     * @return bool return true or false
     */
    public function VerifyUsername($username){
        $this->DB->Run("SELECT * FROM ". UWA_Config::$USERS_TABLE ." WHERE username = :u", [":u" => $username]);
        return $this->DB->NumRows() > 0;
    }

    /**
     * @param $password string
     * @return bool return true or false
     */
    public function VerifyPassword($password){
        $this->User = new User($this->DB->Fetch(\PDO::FETCH_ASSOC)["id"]);
        return password_verify($password, $this->User->Password);
    }

    /**
     * Set up the session
     * @return bool return true or false
     */
    public function SetupSession(){
        Session::Start();
        Session::Add("user", $this->User->ToArray());
        return true;
    }

    /**
     * @return bool return true or false
     */
    public function Login(){
        if($this->VerifyUsername(Sanitiser::String(Input::Post("username")))
        && $this->VerifyPassword(Sanitiser::String(Input::Post("password")))){
            $this->SetupSession();
            return true;
        }
        return false;
    }

    //endregion

}