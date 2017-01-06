<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 02/01/2017
 * Time: 20:00
 */

namespace Untitled\PageBuilder;


use Untitled\Database\Database;
use Application\Config\Database_Config;

class DataProcess
{

    /**
     * @var Database Database object that the DataProcess can use to query the database
     */
    public $db;

    /**
     * DataProcess constructor.
     */
    public function __construct()
    {
        if(!empty(Database_Config::$HOST)
            && !empty(Database_Config::$DBNAME)
            && !empty(Database_Config::$USER)
            && !empty(Database_Config::$PASS)){
            $this->db = new Database();
            $this->db->Connect();
        }
    }

}