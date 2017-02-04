<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 04/02/2017
 * Time: 01:46
 */

namespace System\Libraries\UWebAdmin;


use Application\Config\Twig_Config;
use System\Libraries\Interfaces\IPlugin;
use System\Libraries\UWebAdmin\Models\API\Api;

class UWA implements IPlugin
{

    public static function Start(){
        foreach(self::GetGlobalData() as $glob=>$data){
            Twig_Config::$GLOBAL_DATA[$glob] = $data;
        }
    }

    public static function GetGlobalData(){
        $roles = Api::GetRoles();
        $menu = Api::GetMenuLinks();

        $global["uwa_roles"] = $roles;
        $global["uwa_dashboard_menu"] = $menu;

        return $global;
    }

}