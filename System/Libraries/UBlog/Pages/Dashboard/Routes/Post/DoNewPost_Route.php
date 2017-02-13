<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 03:51
 */

namespace System\Libraries\UBlog\Pages\Dashboard\Routes\Post;


use System\Libraries\UBlog\DataProcesses\UBlog_DataProcess;
use System\Libraries\UBlog\Models\Blogs\Blog;
use System\Libraries\UWebAdmin\Models\Users\User;
use System\Libraries\UWebAdmin\UWA;
use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\Route;

class DoNewPost_Route extends Route
{

    /**
     * DoNewPost_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = "dashboard/blog/%VAR%/post/new/do";
        $this->RenderView = true;
        $this->ViewFilePath = "UBlog/Dashboard/Posts/add.html";
        $this->ComplexRoute = true;
        $this->DataProcess = new UBlog_DataProcess();
        $this->ViewData['page_name'] = "New Post";
    }

    public function RunDataProcess()
    {
        $post = $this->DataProcess->POST->AddPost(null, $this->Params[0]);
        if($post != false){
            $this->ViewData['result'] = true;
            $this->ViewData['post'] = $post;

            $blog = new Blog($this->Params[0], false);

            UWA::NewActivity(new User(Session::Get("user")['Id']), Session::Get("user")['Name']. " wrote new article ". $post->Title. " 
            for ". $blog->Name ." .", time());
        }

    }


}