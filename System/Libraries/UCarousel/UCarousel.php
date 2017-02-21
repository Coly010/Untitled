<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 20/02/2017
 * Time: 22:15
 */

namespace System\Libraries\UCarousel;


use Application\Config\Twig_Config;
use System\Libraries\Interfaces\IPlugin;
use System\Libraries\UCarousel\Config\UCarousel_Config;
use System\Libraries\UCarousel\Config\UCarousel_RouteStrings;
use System\Libraries\UCarousel\Models\Api\Api;
use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Models\Dashboard\MenuItem;
use Untitled\Database\Database;

class UCarousel extends Api implements IPlugin
{
    public static function Start()
    {
        self::RegisterTwigPath();
        self::AddMenuLinks();
    }

    /**
     * Register Twig Path
     */
    public static function RegisterTwigPath(){
        Twig_Config::$TEMPLATE_PATHS[] = "System/Libraries/UCarousel/Views";
    }

    /**
     * Add menu links
     */
    public static function AddMenuLinks(){
        UWA_Config::$MENU_LINKS[] = new MenuItem("UCarousel", null, true);
        UWA_Config::$MENU_LINKS[] = new MenuItem("Add Carousel", DIRECTORY_SEPARATOR.UCarousel_RouteStrings::$ADD_CAROUSEL);
        UWA_Config::$MENU_LINKS[] = new MenuItem("Edit Carousel", DIRECTORY_SEPARATOR.UCarousel_RouteStrings::$EDIT_CAROUSEL);
        UWA_Config::$MENU_LINKS[] = new MenuItem("Delete Carousel", DIRECTORY_SEPARATOR.UCarousel_RouteStrings::$DELETE_CAROUSEL);

        $db = new Database(true);
        $db->Run("SELECT id, name FROM ". UCarousel_Config::$CAROUSEL_TABLE, []);

        if($db->NumRows()){
            $carousels = $db->FetchAll(\PDO::FETCH_ASSOC);
            foreach($carousels as $carousel){
                UWA_Config::$MENU_LINKS[] = new MenuItem($carousel['name'], null, true);
                UWA_Config::$MENU_LINKS[] = new MenuItem("Add Item", "/dashboard/carousel/".$carousel['id']."/item/add");
                UWA_Config::$MENU_LINKS[] = new MenuItem("Edit Item", "/dashboard/carousel/".$carousel['id']."/item/edit");
                UWA_Config::$MENU_LINKS[] = new MenuItem("Delete Item", "/dashboard/carousel/".$carousel['id']."/item/delete");
            }
        }

    }


}