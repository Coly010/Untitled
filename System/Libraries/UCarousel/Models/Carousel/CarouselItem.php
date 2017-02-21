<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 20/02/2017
 * Time: 22:25
 */

namespace System\Libraries\UCarousel\Models\Carousel;


use System\Libraries\UBlog\Models\Blogs\Post;
use System\Libraries\UCarousel\Config\UCarousel_Config;
use System\Libraries\UGallery\Models\Gallery\Media;
use System\Libraries\UWebAdmin\Models\Interfaces\IDeletable;
use System\Libraries\UWebAdmin\Models\Interfaces\IObjArray;
use System\Libraries\UWebAdmin\Models\Interfaces\ISaveable;
use System\Libraries\UWebAdmin\Models\Users\User;
use Untitled\Database\Database;

class CarouselItem implements ISaveable, IDeletable, IObjArray
{

    //region Properties

    /**
     * @var int Id of the item
     */
    public $Id;

    /**
     * @var Carousel Carousel the item belongs to
     */
    public $Carousel;

    /**
     * @var string Header of the item
     */
    public $Header;

    /**
     * @var string Description of the item
     */
    public $Description;

    /**
     * @var Media Media linked to the carousel item
     */
    public $Media;

    /**
     * @var Post Blog post linked to the carousel item
     */
    public $BlogPost;

    /**
     * @var User the user that created the item
     */
    public $User;

    /**
     * @var string the time it was created
     */
    public $Time;

    //endregion

    //region Constructors

    /**
     * CarouselItem constructor.
     * @param null $id id of the item
     */
    public function __construct($id = null)
    {
        if(!is_null($id)){
            $this->Id = $id;

            $db = new Database(true);
            $db->Run("SELECT * FROM ". UCarousel_Config::$CAROUSEL_ITEM_TABLES ." WHERE id = :id", [":id" => $this->Id]);

            if($db->NumRows()){
                $item = $db->Fetch(\PDO::FETCH_ASSOC);

                $this->Header = $item['header'];
                $this->Description = $item['description'];
                $this->Carousel = new Carousel($item['carousel'], false);
                $this->BlogPost = new Post($item['post']);
                $this->Media = new Media($item['media']);
                $this->User = new User($item['user']);
                $this->Time = $item['time'];
            }
        }
    }

    //endregion

    //region ISaveable, IDeletable, IObjArray Methods

    /**
     * Delete the item
     */
    public function Delete()
    {
        $db = new Database(true);
        $db->Run("DELETE FROM ". UCarousel_Config::$CAROUSEL_ITEM_TABLES ." WHERE id = :id", [":id"=>$this->Id]);
    }

    /**
     * Save the item
     */
    public function Save()
    {
        $db = new Database(true);
        $db->Run("UPDATE ". UCarousel_Config::$CAROUSEL_ITEM_TABLES ." SET 
            carousel = :carousel,
            header = :header,
            description = :description,
            media = :media,
            post = :post,
            user = :user,
            time = :time
            WHERE id = :id",
            [
                ":carousel" => $this->Carousel->Id,
                ":header" => $this->Header,
                ":description" => $this->Description,
                ":media" => $this->Media->Id,
                ":post" => $this->BlogPost->Id,
                ":user" => $this->User->Id,
                ":time" => $this->Time,
                ":id" => $this->Id
            ]);
    }

    /**
     * Insert the item
     */
    public function Insert()
    {
        $db = new Database(true);
        $db->Run("INSERT INTO ". UCarousel_Config::$CAROUSEL_ITEM_TABLES ."(
        carousel, header, description, media, post, user, time) VALUES(
        :carousel, :header, :description, :media, :post, :user, :time)",
            [
                ":carousel" => $this->Carousel->Id,
                ":header" => $this->Header,
                ":description" => $this->Description,
                ":media" => $this->Media->Id,
                ":post" => $this->BlogPost->Id,
                ":user" => $this->User->Id,
                ":time" => time()
            ]);
        $this->Id = $db->InsertId();
    }

    /**
     * Return the object to array
     */
    public function ToArray()
    {
        return get_object_vars($this);
    }

    //endregion

}