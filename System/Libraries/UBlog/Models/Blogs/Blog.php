<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 07/02/2017
 * Time: 19:23
 */

namespace System\Libraries\UBlog\Models\Blogs;


use System\Libraries\UBlog\Config\UBlog_Config;
use System\Libraries\UWebAdmin\Models\Interfaces\IDeletable;
use System\Libraries\UWebAdmin\Models\Interfaces\IObjArray;
use System\Libraries\UWebAdmin\Models\Interfaces\ISaveable;
use System\Libraries\UWebAdmin\Models\Users\User;
use Untitled\Database\Database;

class Blog implements ISaveable, IDeletable, IObjArray
{

    //region Properties

    /**
     * @var Integer ID of the blog
     */
    public $Id;

    /**
     * @var string Name of the blog
     */
    public $Name;

    /**
     * @var string Description of the blog
     */
    public $Description;

    /**
     * @var array Post - the posts in the blog
     */
    public $Posts;

    //endregion

    //region Constructors

    /**
     * Blog constructor.
     * @param integer $id id of blog
     */
    public function __construct($id = null, $get_posts = true)
    {
        if(!is_null($id)){
            $this->Id = $id;

            $db = new Database(true);

            $db->Run("SELECT * FROM ". UBlog_Config::$BLOGS_TABLES ." WHERE id = :id", [":id" => $this->Id]);
            $blog = $db->Fetch();

            $this->Name = $blog['name'];
            $this->Description = $blog['description'];

            if($get_posts){

                $db->Run("SELECT * FROM ". UBlog_Config::$BLOG_POSTS_TABLE ." WHERE blog = :blog", [":blog" => $this->Id]);
                $posts = $db->FetchAll(\PDO::FETCH_ASSOC);

                foreach($posts as $post){
                    $Post = new Post();
                    $Post->Id = $post['id'];
                    $Post->Blog = $this;
                    $Post->User = new User($post['id']);
                    $Post->Title = $post['title'];
                    $Post->Content = $post['content'];
                    $Post->SetLikes($post['likes']);
                    $Post->Visible = $post['visible'] == 1 ? true : false;
                    $this->Posts[] = $Post;
                }
            }
        }
    }

    //endregion

    //region ISaveable, IDeleteable, IObjArray Methods

    /**
     * Delete the blog
     */
    public function Delete()
    {
        $db = new Database(true);

        $db->Run("DELETE FROM ". UBlog_Config::$BLOGS_TABLES ." WHERE id = :id", [":id" => $this->Id]);
    }

    /**
     * Save any changes to the blog
     */
    public function Save()
    {
        $db = new Database(true);

        $db->Run("UPDATE ". UBlog_Config::$BLOGS_TABLES ." SET name = :name, description = :desc WHERE id = :id",
            [":name" => $this->Name, ":desc" => $this->Description, ":id" => $this->Id]);
    }

    /**
     * Insert the blog into the database
     */
    public function Insert()
    {
        $db = new Database(true);

        $db->Run("INSERT INTO ". UBlog_Config::$BLOGS_TABLES ."(name, description) VALUES(:name, :description)",
            [":name" => $this->Name, ":description" => $this->Description]);

        $this->Id = $db->InsertId();
    }

    /**
     * Return the object as an array
     * @return array
     */
    public function ToArray()
    {
        return get_object_vars($this);
    }

    //endregion

}