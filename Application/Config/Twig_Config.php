<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 02/01/2017
 * Time: 20:37
 */

namespace Application\Config;


class Twig_Config
{

    /**
     * @var string Path to the templates
     */
    public static $TEMPLATE_PATH = "Application/Views";

    /**
     * @var array Paths to other templates
     */
    public static $TEMPLATE_PATHS = [];

    /**
     * @var string Path to the cache directory
     */
    public static $CACHE_PATH = "Application/Cache";

    /**
     * @var array Global data that is accessible at all times
     */
    public static $GLOBAL_DATA = [];

}