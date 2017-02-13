<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 03/01/2017
 * Time: 03:04
 */

namespace Application\Config;


use System\Libraries\UBlog\UBlog;
use System\Libraries\UGallery\UGallery;
use System\Libraries\UWebAdmin\UWA;

class Application_Config
{

    public static $PAGES_DIR = "Application/Pages";
    public static $DATA_PROCESSES_DIR = "Application/DataProcesses";
    public static $VIEWS_DIR = "Application/Views";

    public static $PLUGINS = [
        UWA::class,
        UBlog::class,
        UGallery::class
    ];

    public static $ENV = "Development";

}