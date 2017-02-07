<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 03/01/2017
 * Time: 02:50
 */

namespace Untitled;

use Application\Config\Application_Config;
use Application\Pages\Error\Error_Page;

class Untitled
{

    /**
     * @var Page Active page
     */
    public $Page = null;

    /**
     * @var string Request string
     */
    public $RequestString = "";

    /**
     * Untitled constructor.
     */
    public function __construct($RequestString){
        $this->RequestString = $RequestString;
        $this->ActivatePlugins();
    }

    /**
     * Find the page and set it to the active page
     */
    public function FindPage(){
        $FilesInPagesDirectory = $this->ScanDirToArray(Application_Config::$PAGES_DIR);

        foreach($FilesInPagesDirectory as $Directory => $FileArray){
            foreach($FileArray as $File) {
                if (!is_array($File) && strpos($File, "_Page") !== false) {
                    $FilePath = Application_Config::$PAGES_DIR . "/" . $Directory . "/" . $File;
                    require $FilePath;

                    $Class = "Application\\Pages\\" .$Directory. "\\" . explode(".", $File)[0];
                    $Page = new $Class();
                    if ($Page->SearchRoutes($this->RequestString)) {
                        $this->Page = $Page;
                        break;
                    }
                }
            }
        }

        if(is_null($this->Page)){
            $this->Page = new Error_Page();
            $this->Page->SearchRoutes("error404");
        }
    }

    /**
     * Run the page logic, then render or return data
     */
    public function RunPage(){
        $this->FindPage();

        $this->Page->ProcessFoundRoute();
    }

    private function ActivatePlugins(){
        foreach(Application_Config::$PLUGINS as $plugin){
            $plugin::Start();
        }
    }

    /**
     * Recursively scan a directory and create an array of results
     * @param $dir
     * @return array
     */
    private function ScanDirToArray($dir) {

        $result = array();

        $cdir = scandir($dir);
        foreach ($cdir as $key => $value)
        {
            if (!in_array($value,array(".","..")))
            {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
                {
                    $result[$value] = $this->ScanDirToArray($dir . DIRECTORY_SEPARATOR . $value);
                }
                else
                {
                    $result[] = $value;
                }
            }
        }
        return $result;
    }

}