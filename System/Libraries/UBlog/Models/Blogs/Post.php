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

class Post implements ISaveable, IDeletable, IObjArray
{

    //region Properties

    /**
     * @var integer Id of the post
     */
    public $Id;

    /**
     * @var Blog Blog the post belongs to
     */
    public $Blog;

    /**
     * @var User User that wrote the post
     */
    public $User;

    /**
     * @var string Title of the post
     */
    public $Title;

    /**
     * @var string Content of the post
     */
    public $Content;

    /**
     * @var array Comments on the post
     */
    public $Comments;

    /**
     * @var array Users that liked the post
     */
    public $Likes;

    /**
     * @var bool Whether the post is visible or not
     */
    public $Visible;

    /**
     * @var string timestamp
     */
    public $Time;

    //endregion

    //region Constructors

    /**
     * Post constructor.
     * @param integer $id
     */
    public function __construct($id = null)
    {
        if(!is_null($id)){
            $this->Id = $id;

            $db = new Database(true);

            $db->Run("SELECT * FROM ". UBlog_Config::$BLOG_POSTS_TABLE ." WHERE id = :id", [":id" => $this->Id]);

            $post = $db->Fetch();
            $this->Blog = new Blog($post['blog']);
            $this->User = new User($post['user']);
            $this->Title = $post['title'];
            $this->Content = $post['content'];
            $this->SetLikes($post['likes']);
            $this->Visible = $post['visible'] == 1 ? true : false;
            $this->Time = $post['time'];
        }
    }

    //endregion

    //region Manipulate Likes

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
     * Delete the post and any associated comments
     */
    public function Delete()
    {
        $db = new Database(true);
        $db->Run("DELETE FROM ". UBlog_Config::$BLOG_POSTS_TABLE ." WHERE id = :id", [":id" => $this->Id]);

        foreach($this->Comments as $comment){
            $comment->Delete();
        }
    }

    /**
     * Save any changes to the post
     */
    public function Save()
    {
        $db = new Database(true);
        $db->Run("UPDATE ". UBlog_Config::$BLOG_POSTS_TABLE ." SET
            blog = :blog,
            user = :user,
            title = :title,
            content = :content,
            likes = :likes,
            visible = :visible,
            time = :time
            WHERE id = :id",
            [
               ":blog" => $this->Blog->Id,
                ":user" => $this->User->Id,
                ":title" => $this->Title,
                ":content" => $this->Content,
                ":likes" => $this->GetLikes(),
                ":visible" => $this->Visible == true ? 1 : 0,
                ":time" => $this->Time,
                ":id" => $this->Id
            ]);
    }

    /**
     * Insert the post into the database
     */
    public function Insert()
    {
        $db = new Database(true);
        $db->Run("INSERT INTO ". UBlog_Config::$BLOG_POSTS_TABLE ."(blog, user, title, content, likes, visible, time)
        VALUES(:blog, :user, :title, :content, :likes, :visible, :time)",
            [
                ":blog" => $this->Blog->Id,
                ":user" => $this->User->Id,
                ":title" => $this->Title,
                ":content" => $this->Content,
                ":likes" => $this->GetLikes(),
                ":visible" => $this->Visible == true ? 1 : 0,
                ":time" => time()
            ]);
        $this->Id = $db->InsertId();
    }

    /**
     * @return array object as array
     */
    public function ToArray()
    {
        return get_object_vars($this);
    }

    //endregion

}