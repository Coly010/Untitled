<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 02/02/2017
 * Time: 20:00
 */

namespace System\Libraries\UWebAdmin\Models\API;


use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Models\Users\Role;
use Untitled\Database\Database;

class Api
{

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

    /**
     * @return array Menu links associative array
     * Turn the menu links into an associative array
     */
    public static function GetMenuLinks(){
        $Menu = [];
        foreach(UWA_Config::$MENU_LINKS as $link){
            $Menu[] = ["link" => $link[0], "url" => $link[1]];
        }
        return $Menu;
    }

}