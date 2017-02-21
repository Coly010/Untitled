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
use System\Libraries\UCarousel\Models\Api\Api;
use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Models\Dashboard\MenuItem;
use System\Libraries\UWebAdmin\UWA;

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
        UWA_Config::$MENU_LINKS[] = new MenuItem();
    }


}