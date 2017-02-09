<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 07/02/2017
 * Time: 19:21
 */

namespace System\Libraries\UBlog\Models\Api;


use System\Libraries\UBlog\Config\UBlog_Config;
use System\Libraries\UBlog\Models\Blogs\Blog;
use System\Libraries\UBlog\Models\Blogs\Post;
use Untitled\Database\Database;

class Api
{

    /**
     * @return array|bool return all the blogs that have been created
     */
    public static function GetBlogs(){
        $db = new Database(true);
        $db->Run("SELECT id FROM ". UBlog_Config::$BLOGS_TABLES, []);

        if($db->NumRows()){
            return false;
        }

        $Blogs = [];
        foreach($db->FetchAll() as $blog){
            $Blogs[] = new Blog($blog['id']);
        }

        return $Blogs;
    }

    /**
     * @param $blog The id of the blog to get the posts
     * @return array|bool Return all the posts from the blog specified
     */
    public static function GetPostsFromBlog($blog){
        $db = new Database(true);
        $db->Run("SELECT id FROM ". UBlog_Config::$BLOG_POSTS_TABLE ." WHERE blog = :blog", [":blog" => $blog]);

        if($db->NumRows()){
            return false;
        }

        $Posts = [];
        foreach($db->FetchAll() as $post){
            $Posts[] = new Post($post['id']);
        }

        return $Posts;
    }

}