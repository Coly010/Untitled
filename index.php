<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 03/01/2017
 * Time: 02:47
 */

use Untitled\Untitled;
use Untitled\Libraries\Input\Sanitiser\Sanitiser;

require_once "System/Untitled_Autoloader.php";
Untitled_Autoloader::register();

$RequestString = isset($_GET['route']) ? Sanitiser::String($_GET['route']) : "home";

if(substr($RequestString, -1) == "/"){
    $RequestString = substr($RequestString, 0, -1);
}

try {
    $System = new Untitled($RequestString);
    $System->RunPage();
} catch(Exception $ex) {
    echo $ex->getMessage();
}