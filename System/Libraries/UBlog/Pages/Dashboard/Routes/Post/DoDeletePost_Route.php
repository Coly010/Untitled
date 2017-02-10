<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 03:52
 */

namespace System\Libraries\UBlog\Pages\Dashboard\Routes\Post;


use System\Libraries\UBlog\DataProcesses\UBlog_DataProcess;
use System\Libraries\UBlog\Models\Blogs\Blog;
use System\Libraries\UBlog\UBlog;
use System\Libraries\UWebAdmin\Models\Users\User;
use System\Libraries\UWebAdmin\UWA;
use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\Route;

class DoDeletePost_Route extends Route
{

    /**
     * DoDeletePost_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = "dashboard/blog/%VAR%/post/delete/do";
        $this->RenderView = true;
        $this->ViewFilePath = "UBlog/Dashboard/Posts/delete.html";
        $this->ComplexRoute = true;
        $this->ViewData['page_name'] = "Delete Post";
        $this->DataProcess = new UBlog_DataProcess();
    }

    public function RunDataProcess()
    {
        $post = $this->DataProcess->POST->DeletePost();
        if($post != false){
            $this->ViewData['result'] = true;
            $this->ViewData['post'] = $post;

            $blog = new Blog($this->Params[0], false);

            UWA::NewActivity(new User(Session::Get("user")['Id']), Session::Get("user")['Name']. " deleted article ". $post->Title. " 
            on ". $blog->Name ." .", time());
        }
        
        $this->ViewData['blog'] = $this->Params[0];
        $this->ViewData['all_posts'] = UBlog::GetPostsFromBlog($this->Params[0]);

    }


}