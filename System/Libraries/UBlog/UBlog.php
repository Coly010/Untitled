<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 07/02/2017
 * Time: 19:05
 */

namespace System\Libraries\UBlog;


use System\Libraries\Interfaces\IPlugin;
use System\Libraries\UBlog\Config\UBlog_Config;
use System\Libraries\UBlog\Config\UBlog_RouteStrings;
use System\Libraries\UBlog\Models\Api\Api;
use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Models\Dashboard\MenuItem;
use Untitled\Database\Database;

class UBlog extends Api implements IPlugin
{

    /**
     * Start the plugin
     */
    public static function Start()
    {
        self::AddMenuLinks();
        self::GetDynamicLinks();

    }

    /**
     * Add the standard menu links
     */
    private static function AddMenuLinks(){
        UWA_Config::$MENU_LINKS[] = new MenuItem("Blog Settings", null, true);

        UWA_Config::$MENU_LINKS[] = new MenuItem("Add Blog", DIRECTORY_SEPARATOR.UBlog_RouteStrings::$ADD_BLOG);
        UWA_Config::$MENU_LINKS[] = new MenuItem("Edit Blog", DIRECTORY_SEPARATOR.UBlog_RouteStrings::$EDIT_BLOG);
        UWA_Config::$MENU_LINKS[] = new MenuItem("Delete Blog", DIRECTORY_SEPARATOR.UBlog_RouteStrings::$DELETE_BLOG);
    }

    /**
     * Add the additional dynamic menu links based on the blogs in the app
     */
    private static function GetDynamicLinks(){
        $db = new Database(true);
        $db->Run("SELECT * FROM ". UBlog_Config::$BLOGS_TABLES, []);

        if($db->NumRows()){
            foreach($db->FetchAll() as $blog){
                UWA_Config::$MENU_LINKS[] = new MenuItem($blog['name'], null, true);
                UWA_Config::$MENU_LINKS[] = new MenuItem("New Post", DIRECTORY_SEPARATOR."dashboard/blog/".$blog['id']."/post/new");
                UWA_Config::$MENU_LINKS[] = new MenuItem("Edit Post", DIRECTORY_SEPARATOR."dashboard/blog/".$blog['id']."/post/edit");
                UWA_Config::$MENU_LINKS[] = new MenuItem("Delete Post", DIRECTORY_SEPARATOR."dashboard/blog/".$blog['id']."/post/delete");
            }
        }

    }

}