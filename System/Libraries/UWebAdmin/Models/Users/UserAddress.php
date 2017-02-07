<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 07/01/2017
 * Time: 01:24
 */

namespace System\Libraries\UWebAdmin\Models\Users;


use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\Models\Interfaces\IDeletable;
use System\Libraries\UWebAdmin\Models\Interfaces\IObjArray;
use System\Libraries\UWebAdmin\Models\Interfaces\ISaveable;
use Untitled\Database\Database;

class UserAddress implements ISaveable, IDeletable, IObjArray
{

    //region Properties

    /**
     * @var number Id - Id of address
     */
    public $Id;

    /**
     * @var number Id - Id of user
     */
    public $UserId;

    /**
     * @var string  Line1 - line1 of address
     */
    public $Line1;

    /**
     * @var string Line2 - Line 2 of address
     */
    public $Line2;

    /**
     * @var string City - City of address
     */
    public $City;

    /**
     * @var string Country - Country of address
     */
    public $Country;

    /**
     * @var string Zip - Zipcode of address
     */
    public $Zip;

    //endregion

    //region Constructors

    /**
     * UserAddress constructor.
     * @param number $id - user id
     */
    public function __construct($id = null)
    {
        if(!is_null($id)) {
            $this->UserId = $id;

            $db = new Database();
            $db->Connect();

            $db->Run("SELECT * FROM " . UWA_Config::$USER_ADDRESSES_TABLE . " WHERE user_id = :id", [":id" => $this->UserId]);
            $address = $db->Fetch(\PDO::FETCH_ASSOC);

            $this->Id = $address['id'];
            $this->Line1 = $address['line1'];
            $this->Line2 = $address['line2'];
            $this->City = $address['city'];
            $this->Country = $address['country'];
            $this->Zip = $address['zip'];
        }
    }

    //endregion

    //region ISaveable, IDeletable, IObjArray Methods

    /**
     * Save any changes to the database
     */
    public function Save(){
        $db = new Database();
        $db->Connect();

        $db->Run("UPDATE ". UWA_Config::$USER_ADDRESSES_TABLE ." SET
            user_id = :userid,
            line1 = :line1,
            line2 = :line2,
            city = :city,
            country = :country,
            zip = :zip
            WHERE id = :id",
            [":userid" => $this->UserId,
                ":line1" => $this->Line1,
                ":line2" => $this->Line2,
                ":city" => $this->City,
                ":country" => $this->Country,
                ":zip" => $this->Zip,
                ":id" => $this->Id
            ]);
    }

    /**
     * Insert a new record to the database
     */
    public function Insert()
    {
        $db = new Database();
        $db->Connect();

        $db->Run("INSERT INTO ". UWA_Config::$USER_ADDRESSES_TABLE ."(
            user_id, line1, line2, city, country, zip)
            VALUES(:userid, :line1, :line2, :city, :country, :zip)",
            [":userid" => $this->UserId,
                ":line1" => $this->Line1,
                ":line2" => $this->Line2,
                ":city" => $this->City,
                ":country" => $this->Country,
                ":zip" => $this->Zip
            ]);
    }

    /**
     * Delete record from the database
     */
    public function Delete(){
        $db = new Database();
        $db->Connect();

        $db->Run("DELETE FROM ". UWA_Config::$USER_ADDRESSES_TABLE ." id = :id", [":id" => $this->Id]);
    }

    /**
     * @return array Object as array
     */
    public function ToArray()
    {
        return get_object_vars($this);
    }

    //endregion

}