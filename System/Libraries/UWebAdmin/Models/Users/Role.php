<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 07/01/2017
 * Time: 01:47
 */

namespace System\Libraries\UWebAdmin\Models\Users;


use System\Libraries\UWebAdmin\Config\UWA_Config;
use Untitled\Database\Database;

class Role
{

    /**
     * @var int Role Id
     */
    public $Id;

    /**
     * @var string Role name
     */
    public $Name;

    /**
     * @var string Role description
     */
    public $Description;

    /**
     * Role constructor.
     * @param $id int Role id
     */
    public function __construct($id){

        $this->Id = $id;

        $db = new Database();
        $db->Connect();

        $db->Run("SELECT * FROM ". UWA_Config::$ROLES_TABLE ." WHERE id = :id", [":id" => $this->Id]);
        $role = $db->Fetch(\PDO::FETCH_ASSOC);

        $this->Name = $role['name'];
        $this->Description = $role['description'];

    }

}