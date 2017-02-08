<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 07/02/2017
 * Time: 19:24
 */

namespace System\Libraries\UBlog\Models\Blogs;


use System\Libraries\UBlog\Config\UBlog_Config;
use System\Libraries\UWebAdmin\Models\Interfaces\IDeletable;
use System\Libraries\UWebAdmin\Models\Interfaces\IObjArray;
use System\Libraries\UWebAdmin\Models\Interfaces\ISaveable;
use System\Libraries\UWebAdmin\Models\Users\User;
use Untitled\Database\Database;

class Comment implements ISaveable, IDeletable, IObjArray
{

    //region Properties

    /**
     * @var int ID of the comment
     */
    public $Id;

    /**
     * @var Post post that the comment belongs to
     */
    public $Post;

    /**
     * @var User user that made the comment
     */
    public $User;

    /**
     * @var string the comment
     */
    public $Comment;

    /**
     * @var array of user ids of likes
     */
    public $Likes;

    /**
     * @var bool determines whether the comment is visible
     */
    public $Visible;

    /**
     * @var string timestamp
     */
    public $Time;

    //endregion

    //region Constructors

    /**
     * Comment constructor.
     * @param integer $id Id of the comment
     */
    public function __construct($id = null)
    {
        if(!is_null($id)){
            $this->Id = $id;

            $db = new Database(true);
            $db->Run("SELECT * FROM ". UBlog_Config::$BLOG_COMMENTS_TABLE ." WHERE id = :id", [":id" => $this->Id]);

            $comment = $db->Fetch();
            $this->Post = new Post($comment['post']);
            $this->User = new User($comment['user']);
            $this->Comment = $comment['comment'];
            $this->SetLikes($comment['likes']);
            $this->Visible = $comment['visible'] == 1 ? true : false;
            $this->Time = $comment['time'];
        }
    }

    //endregion

    //region Likes Manipulation

    /**
     * @param $likes array of user ids
     */
    public function SetLikes($likes){
        $likes = unserialize($likes);
        foreach($likes as $like){
            $this->Likes[] = new User($like);
        }
    }

    /**
     * @return string serialized string of user ids
     */
    public function GetLikes(){
        $Likes = [];
        foreach($this->Likes as $like){
            $Likes[] = $like->Id;
        }
        return serialize($Likes);
    }

    //endregion

    //region ISaveable, IDeletable, IObjArray Methods

    /**
     * Delete the comment
     */
    public function Delete()
    {
        $db = new Database(true);
        $db->Run("DELETE FROM ". UBlog_Config::$BLOG_COMMENTS_TABLE ." WHERE id = :id", [":id" => $this->Id]);
    }

    /**
     * Save any changes to the comment
     */
    public function Save()
    {
        $db = new Database(true);
        $db->Run("UPDATE ". UBlog_Config::$BLOG_COMMENTS_TABLE ." SET 
            post = :post, user = :user, comment = :comment, likes = :likes, visible = :visible, time = :time
            WHERE id = :id",
            [
                ":post" => $this->Post->Id,
                ":user" => $this->User->Id,
                ":comment" => $this->Comment,
                ":likes" => $this->GetLikes(),
                ":visible" => $this->Visible == true ? 1 : 0,
                ":time" => $this->Time,
                ":id" => $this->Id
            ]);
    }

    /**
     * Insert a new comment to a database
     */
    public function Insert()
    {
        $db = new Database(true);
        $db->Run("INSERT INTO ". UBlog_Config::$BLOG_COMMENTS_TABLE ."(post, user, comment, likes, visible, time)
            VALUES(:post, :user, :comment, :likes, :visible, :time)",
            [
                ":post" => $this->Post->Id,
                ":user" => $this->User->Id,
                ":comment" => $this->Comment,
                ":likes" => $this->GetLikes(),
                ":visible" => $this->Visible == true ? 1 : 0,
                ":time" => $this->Time
            ]);
    }

    /**
     * @return array convert the object to array
     */
    public function ToArray()
    {
        return get_object_vars($this);
    }

    //endregion

}