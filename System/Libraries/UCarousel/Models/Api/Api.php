<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 20/02/2017
 * Time: 22:16
 */

namespace System\Libraries\UCarousel\Models\Api;


use System\Libraries\UCarousel\Config\UCarousel_Config;
use System\Libraries\UCarousel\Models\Carousel\Carousel;
use System\Libraries\UCarousel\Models\Carousel\CarouselItem;
use Untitled\Database\Database;

class Api
{

    /**
     * @return array of Carousels
     */
    public static function GetAllCarousels(){
        $db = new Database(true);
        $db->Run("SELECT id FROM ". UCarousel_Config::$CAROUSEL_TABLE, []);

        $Carousels = [];
        if($db->NumRows()){
            foreach($db->FetchAll(\PDO::FETCH_ASSOC) as $carousel){
                $Carousels[] = new Carousel($carousel['id']);
            }
        }
        return $Carousels;
    }

    /**
     * @param $name string name of the carousel
     * @return bool|Carousel
     */
    public static function GetCarouselByName($name){
        $db = new Database(true);
        $db->Run("SELECT id FROM ". UCarousel_Config::$CAROUSEL_TABLE ." WHERE name = :name", [":name" => $name]);

        if(!$db->NumRows()){
            return false;
        }

        return new Carousel($db->Fetch(\PDO::FETCH_ASSOC)['id']);
    }

    /**
     * @param $carousel int ID of the carousel
     * @return array|bool
     */
    public static function GetCarouselItems($carousel){
        $db = new Database(true);
        $db->Run("SELECT id FROM ". UCarousel_Config::$CAROUSEL_ITEM_TABLES ." WHERE carousel = :id", [":id" => $carousel]);

        if(!$db->NumRows()){
            return false;
        }

        $Items = [];
        foreach($db->FetchAll(\PDO::FETCH_ASSOC) as $item){
            $Items[] = new CarouselItem($item['id']);
        }

        return $Items;

    }

    /**
     * @return array|bool the carousel items
     */
    public static function GetAllCarouselItems(){
        $db = new Database(true);
        $db->Run("SELECT id FROM ". UCarousel_Config::$CAROUSEL_ITEM_TABLES, []);

        if(!$db->NumRows()){
            return false;
        }

        $Items = [];
        foreach($db->FetchAll(\PDO::FETCH_ASSOC) as $item){
            $Items[] = new CarouselItem($item['id']);
        }

        return $Items;
    }

}