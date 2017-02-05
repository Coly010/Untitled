<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 05/02/2017
 * Time: 16:30
 */

namespace System\Libraries\UWebAdmin\Models\Dashboard;


use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Models\Interfaces\IDeletable;
use System\Libraries\UWebAdmin\Models\Interfaces\IObjArray;
use System\Libraries\UWebAdmin\Models\Interfaces\ISaveable;
use Untitled\Database\Database;

class Activity implements ISaveable, IDeletable, IObjArray
{

    //region Properties
    /**
     * @var int ID of the activity
     */
    public $Id;

    /**
     * @var User the user that created the activity
     */
    public $User;

    /**
     * @var string, the activity
     */
    public $Activity;

    /**
     * @var string, the tme in milliseconds
     */
    public $Time;
    //endregion

    //region Constructors
    /**
     * Activity constructor.
     * @param int $id id of the activity
     */
    public function __construct($id = null){

        if(!is_null($id)){
            $this->Id = $id;

            $db = new Database(true);

            $db->Run("SELECT * FROM ". UWA_Config::$LATEST_ACTIVITY_TABLE ." WHERE id = :id", [":id"=>$this->Id]);
            $activity = $db->Fetch();

            $this->User = new User($activity['user_id']);
            $this->Activity = $activity['activity'];
            $this->Time = $activity['time'];
        }

    }
    //endregion

    //region IObjArray, IDeletable, ISaveable Methods
    public function Delete()
    {
        $db = new Database(true);

        $db->Run("DELETE FROM ". UWA_Config::$LATEST_ACTIVITY_TABLE ." WHERE id = :id", [":id"=>$this->Id]);
    }

    public function ToArray()
    {
        return get_object_vars($this);
    }

    public function Save()
    {
        $db = new Database(true);

        $db->Run("UPDATE ". UWA_Config::$LATEST_ACTIVITY_TABLE ." SET 
                user_id = :uid, activity = :activity, time = :time WHERE id = :id",
            [
                ":uid" => $this->User->Id,
                ":activity" => $this->Activity,
                ":time" => $this->Time,
                ":id" => $this->Id
            ]);
    }

    public function Insert()
    {
        $db = new Database(true);

        $db->Run("INSERT INTO ". UWA_Config::$LATEST_ACTIVITY_TABLE ."(user_id, activity, time) VALUES(:uid, :activity, :time)",
            [
                ":uid" => $this->User->Id,
                ":activity" => $this->Activity,
                ":time" => time()
            ]);

        $this->Id = $db->InsertId();
    }
    //endregion
    
}