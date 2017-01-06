<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 02/01/2017
 * Time: 20:12
 */

class Untitled_Autoloader
{

    public static function register(){

        spl_autoload_register(function($class) {
            // TWIG
            if (0 === strpos($class, 'Twig')) {
                if(strpos($class, 'Twig_Loader_FileSystem') !== false){
                    $class = "Twig_Loader_Filesystem";
                }
                $twigDirs = str_replace(array('_', "\0"), array('/', ''), $class);
                $file = dirname(__FILE__).'/Libraries/'.$twigDirs.'.php';
                if (is_file($file)) {
                    require $file;
                    return;
                }
            }
            // END TWIG


            if(substr($class, 0, 8) == "Untitled" && strpos($class, "Application") === false){
                $class = "System" . substr($class, 8);
            }
            if(strpos($class, "Application") !== false && strpos($class, "Untitled") !== false){
                $class = substr($class, 9);
            }

            $location = str_replace('\\', '/', $class) . ".php";

            if(is_file($location)){
                require_once($location);
                return;
            } else {
                throw new \Exception("Cannot find application file " . $location);
            }

        });


    }

}