<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 03/01/2017
 * Time: 02:47
 */

use Untitled\Untitled;

require_once "System/Untitled_Autoloader.php";
Untitled_Autoloader::register();

$RequestString = isset($_GET['route']) ? $_GET['route'] : "home";

try {
    $System = new Untitled($RequestString);
    $System->RunPage();
} catch(Exception $ex) {
    echo $ex->getMessage();
}