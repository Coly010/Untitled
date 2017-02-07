<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 02/01/2017
 * Time: 23:40
 */

namespace Untitled\Database;

use Application\Config;
use Untitled\Libraries\ULogger\ULogger;

class Database
{

    /**
     * @var PDO Object
     */
    public $DB;

    /**
     * @var string The previous query that was run
     */
    private $LastQuery = "";

    /**
     * @var string The current query being run
     */
    private $CurrentQuery = "";

    /**
     * @var array Previous params that were used
     */
    private $PreviousParams = [];

    /**
     * @var array Current params being used
     */
    private $CurrentParams = [];

    /**
     * @var Current PDOStatement
     */
    private $CurrentStmt = null;

    /**
     * @var The current result set
     */
    private $CurrentResult = null;

    /**
     * @var int Number of affected rows
     */
    private $AffectedRows = 0;

    /**
     * @var int Number of rows counted
     */
    private $NumRows = 0;

    /**
     * @var int Id of the row inserted
     */
    private $InsertId = 0;

    /**
     * Database constructor.
     */
    public function __construct($coonect = false) {
        if($coonect){
            $this->Connect();
        }
    }

    /**
     * Connect to the database
     * @throws \Exception
     */
    public function Connect(){
        $this->DB = new \PDO(
            'mysql:host='.Config\Database_Config::$HOST.';dbname='.Config\Database_Config::$DBNAME,
            Config\Database_Config::$USER,
            Config\Database_Config::$PASS
        );

        if($this->DB->errorCode()){
            throw new \Exception("Cannot connect to the database");
        }
    }

    /**
     * Run a SQL Query
     * @param $sql
     * @return mixed
     * @throws \Exception
     */
    public function Query($sql){
        $this->LastQuery = $this->CurrentQuery;
        $this->CurrentQuery = $sql;

        try {
            $stmt = $this->DB->query($sql);
        } catch(\PDOException $ex) {
            throw new \Exception($ex->getMessage());
        }

        $this->AffectedRows = $stmt->rowCount();
        $this->NumRows = $stmt->rowCount();

        $this->InsertId = $this->DB->lastInsertId();

        $this->CurrentStmt = $stmt;

        return $stmt;
    }

    /**
     * Prepare a sql query, to allow parameters to be bound to it
     * @param $sql
     * @return mixed
     * @throws \Exception
     */
    public function Prepare($sql){
        $this->LastQuery = $this->CurrentQuery;
        $this->CurrentQuery = $sql;

        try {
            $this->CurrentStmt = $this->DB->prepare($sql);
        } catch(\PDOException $ex) {
            throw new \Exception($ex->getMessage());
        }

        return $this->CurrentStmt;
    }

    /**
     * Execute the prepared sql query, with the params attached
     * @param $params
     * @return mixed
     * @throws \Exception
     */
    public function Execute($params = []){
        $this->PreviousParams = $this->CurrentParams;
        $this->CurrentParams = $params;

        try {
            $this->CurrentStmt->execute($params);
        } catch(\PDOException $ex) {
            throw new \Exception($ex->getMessage());
        }

        $this->AffectedRows = $this->CurrentStmt->rowCount();
        $this->NumRows = $this->CurrentStmt->rowCount();

        $this->InsertId = $this->DB->lastInsertId();

        return $this->CurrentStmt;

    }

    /**
     * Combine the prepare and execute methods in one
     * @param $sql
     * @param $params
     * @return mixed
     */
    public function Run($sql, $params){
        $this->Prepare($sql);
        $this->Execute($params);

        return $this->CurrentStmt;
    }

    /**
     * Fetch the result set
     * @param $FetchType
     * @return mixed
     * @throws \Exception
     */
    public function Fetch($FetchType = \PDO::FETCH_BOTH){

        try {
            $result = $this->CurrentStmt->fetch($FetchType);
        } catch(\PDOException $ex) {
            throw new \Exception($ex->getMessage());
        }

        $this->CurrentResult = $result;

        return $result;

    }

    /**
     * Fetch the full result set
     * @param $FetchType
     * @return mixed
     * @throws \Exception
     */
    public function FetchAll($FetchType = \PDO::FETCH_BOTH){

        try {
            $result = $this->CurrentStmt->fetchAll($FetchType);
        } catch(\PDOException $ex){
            throw new \Exception($ex->getMessage());
        }

        $this->CurrentResult = $result;

        return $result;

    }

    /**
     * Return the number of rows
     * @return int
     */
    public function NumRows(){
        return $this->NumRows;
    }

    /**
     * Return the number of affected rows
     * @return int
     */
    public function AffectedRows(){
        return $this->AffectedRows;
    }

    /**
     * Return the ID of the last inserted row
     * @return int
     */
    public function InsertId(){
        return $this->InsertId;
    }

}