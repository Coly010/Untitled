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
use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Config\UWA_RouteStrings;
use System\Libraries\UWebAdmin\Models\API\Api;
use System\Libraries\UWebAdmin\Models\Dashboard\MenuItem;
use Untitled\Libraries\Session\Session;

class UWA extends Api implements IPlugin
{

    /**
     * Plugin starting point
     */
    public static function Start(){
        self::SetupMenuLinks();

        foreach(self::GetGlobalData() as $glob=>$data){
            Twig_Config::$GLOBAL_DATA[$glob] = $data;
        }
    }

    public static function SetupMenuLinks(){
        UWA_Config::$MENU_LINKS[] = new MenuItem("Home", UWA_RouteStrings::$DASHBOARD);

        UWA_Config::$MENU_LINKS[] = new MenuItem("Users", null, true);
        UWA_Config::$MENU_LINKS[] = new MenuItem("Add User", UWA_RouteStrings::$ADD_USER);
        UWA_Config::$MENU_LINKS[] = new MenuItem("Edit User", UWA_RouteStrings::$EDIT_USER);
        UWA_Config::$MENU_LINKS[] = new MenuItem("Delete User", UWA_RouteStrings::$DELETE_USER);
        UWA_Config::$MENU_LINKS[] = new MenuItem("My Account", UWA_RouteStrings::$MY_ACCOUNT);
    }

    /**
     * @return mixed array of global data
     */
    public static function GetGlobalData(){
        $roles = Api::GetRoles();
        $menu = Api::GetMenuLinks();

        $global["uwa_roles"] = $roles;
        $global["uwa_dashboard_menu"] = $menu;

        Session::Start();
        if($user = Session::Get("user")){
            $global["uwa_user"] = $user;
        }

        return $global;
    }

}