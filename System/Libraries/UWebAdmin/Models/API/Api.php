<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 02/02/2017
 * Time: 20:00
 */

namespace System\Libraries\UWebAdmin\Models\API;


use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Models\Dashboard\Activity;
use System\Libraries\UWebAdmin\Models\Users\Role;
use System\Libraries\UWebAdmin\Models\Users\User;
use Untitled\Database\Database;

class Api
{

    //region Dashboard API

    /**
     * @return array Menu links associative array
     * Turn the menu links into an associative array
     */
    public static function GetMenuLinks(){
        $Menu = [];
        foreach(UWA_Config::$MENU_LINKS as $item){
            $Menu[] = $item->ToArray();
        }
        return $Menu;
    }

    //endregion

    //region Users API

    /**
     * Get all the registered users
     * @return array User array
     */
    public static function GetUsers(){
        $db = new Database(true);
        $db->Run("SELECT id FROM ". UWA_Config::$USERS_TABLE, []);

        $Users = [];
        foreach($db->FetchAll(\PDO::FETCH_ASSOC) as $user) {
            $Users[] = new User($user['id']);
        }

        return $Users;
    }

    /**
     * Get a registered user
     * @return User object
     */
    public static function GetUser($id){
        return new User($id);
    }

    /**
     * @return array Roles objects
     * Get the roles that are in the application
     */
    public static function GetRoles(){
        $Roles = [];
        $db = new Database(true);

        $db->Run("SELECT id FROM ". UWA_Config::$ROLES_TABLE, []);
        foreach($db->FetchAll(\PDO::FETCH_ASSOC) as $role){
            $Roles[] = new Role($role['id']);
        }

        return $Roles;
    }

    //endregion

    //region Latest Activity API

    /**
     * Get the latest activity that has occurred on the dashboard
     * @param int $limit
     * @return array
     */
    public static function GetLatestActivity($limit = null){

        $sql = "SELECT * FROM ".
            UWA_Config::$LATEST_ACTIVITY_TABLE .
            (!is_null($limit) ? " LIMIT" . $limit : "") .
            " ORDER BY time DESC";

        $db = new Database(true);

        $db->Run($sql, []);

        $Activity = [];
        foreach($db->FetchAll(\PDO::FETCH_ASSOC) as $activity){
            $a = new Activity();
            $a->Id = $activity['id'];
            $a->User = new User($activity['user_id']);
            $a->Activity = $activity['activity'];
            $a->Time = $activity['time'];

            $Activity[] = $a;
        }

        return $Activity;
    }

    /**
     * Add a new activity
     * @param Activity $activity
     */
    public static function AddActivity($activity){
        $activity->Insert();
    }

    /**
     * Add a new activity
     * @param User $user
     * @param string $activity
     * @param string $time
     */
    public static function NewActivity($user, $activity, $time){
        $a = new Activity();
        $a->User = $user;
        $a->Activity = $activity;
        $a->Time = $time;

        $a->Insert();
    }

    //endregion

}