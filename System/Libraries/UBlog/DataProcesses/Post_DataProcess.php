<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 11:13
 */

namespace System\Libraries\UBlog\DataProcesses;


use System\Libraries\UBlog\Models\Blogs\Blog;
use System\Libraries\UBlog\Models\Blogs\Post;
use System\Libraries\UWebAdmin\Models\Users\User;
use Untitled\Libraries\Input\Input;
use Untitled\Libraries\Input\Sanitiser\Sanitiser;
use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\DataProcess;

class Post_DataProcess extends DataProcess
{

    /**
     * @param Post $post post to add
     * @param integer $blog the id of the blog
     * @return Post the post that was added
     */
    public function AddPost($post = null, $blog = null){
        if(is_null($post)){
            $post = new Post();

            $post->Title = Sanitiser::String(Input::Post("title"));
            $post->Content = Sanitiser::String(Input::Post("content"));

            $post->Blog = new Blog($blog, false);
            $post->User = new User(Session::Get("user")['Id']);
            $post->Time = time();
        }

        $post->Insert();
        return $post;
    }

    /**
     * @param Post $post the post to edit
     * @return Post the post that was edited
     */
    public function EditPost($post = null){
        if(is_null($post)){
            $post = new Post(Sanitiser::Int(Input::Post("ID")));

            $post->Title = Sanitiser::String(Input::Post("title"));
            $post->Content = Sanitiser::String(Input::Post("content"));
        }

        $post->Save();
        return $post;
    }

    /**
     * @param Post $post - the post to delete
     * @return Post the deleted post
     */
    public function DeletePost($post = null){
        if(is_null($post)){
            $post = new Post(Sanitiser::Int(Input::Post("selected-post")));
        }

        $post->Delete();
        return $post;
    }

}