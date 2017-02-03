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
        $db = new Database();

        $db->Run("SELECT id FROM ". UWA_Config::$ROLES_TABLE, []);
        foreach($db->FetchAll(\PDO::FETCH_ASSOC) as $role){
            $Roles[] = new Role($role['id']);
        }

        return $Roles;
    }

}