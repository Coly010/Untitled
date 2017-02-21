<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 20/02/2017
 * Time: 22:25
 */

namespace System\Libraries\UCarousel\Models\Carousel;


use System\Helpers\DateTime\DateTime_Helper;
use System\Libraries\UCarousel\Config\UCarousel_Config;
use System\Libraries\UWebAdmin\Models\Interfaces\IDeletable;
use System\Libraries\UWebAdmin\Models\Interfaces\IObjArray;
use System\Libraries\UWebAdmin\Models\Interfaces\ISaveable;
use Untitled\Database\Database;

class Carousel implements ISaveable, IDeletable, IObjArray
{

    //region Properties

    /**
     * @var int Id of the Carousel
     */
    public $Id;

    /**
     * @var string Name of the Carousel
     */
    public $Name;

    /**
     * @var array CarouselItems
     */
    public $Items;

    //endregion

    //region Constructors

    /**
     * Carousel constructor.
     */
    public function __construct($id = null, $items = true)
    {
        if(!is_null($id)){
            $this->Id = $id;

            $db = new Database(true);

            $db->Run("SELECT * FROM ". UCarousel_Config::$CAROUSEL_TABLE ." WHERE id = :id", [":id" => $this->Id]);

            if($db->NumRows()){
                $carousel = $db->Fetch(\PDO::FETCH_ASSOC);

                $this->Name = $carousel['name'];
                $this->Items = [];

                if($items){
                    $db->Run("SELECT id FROM ". UCarousel_Config::$CAROUSEL_ITEM_TABLES ." WHERE carousel = :id",
                        [":id" => $this->Id]);

                    if($db->NumRows()){
                        foreach($db->FetchAll(\PDO::FETCH_ASSOC) as $item){
                            $this->Items[] = new CarouselItem($item['id']);
                        }
                    }
                }
            }
        }
    }

    //endregion

    //region ISaveable, IDeletable, IObjArray

    /**
     * Delete the carousel
     */
    public function Delete()
    {
        $db = new Database(true);
        $db->Run("DELETE FROM ". UCarousel_Config::$CAROUSEL_TABLE ." WHERE id = :id", [":id" => $this->Id]);
    }

    /**
     * Save the carousel
     */
    public function Save()
    {
        $db = new Database(true);
        $db->Run("UPDATE ". UCarousel_Config::$CAROUSEL_TABLE ." SET name = :name WHERE id = :id",
            [":name" => $this->Name, ":id" => $this->Id]);

        foreach($this->Items as $item){
            $item->Carousel = $this->Id;
            $item->Save();
        }
    }

    /**
     * Insert the carousel
     */
    public function Insert()
    {
        $db = new Database(true);
        $db->Run("INSERT INTO ". UCarousel_Config::$CAROUSEL_TABLE ."(name) VALUES(:name)", [":name" => $this->Name]);

        $this->Id = $db->InsertId();

        if(is_array($this->Items) && count($this->Items) > 0){
            foreach($this->Items as $item){
                $item->Carousel = $this->Id;
                $item->Insert();
            }
        }
    }

    /**
     * Object to array
     */
    public function ToArray()
    {
        return get_object_vars($this);
    }

    //endregion


}