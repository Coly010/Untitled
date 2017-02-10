<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 03:52
 */

namespace System\Libraries\UBlog\Pages\Dashboard\Routes\Post;


use System\Libraries\UBlog\DataProcesses\UBlog_DataProcess;
use System\Libraries\UBlog\UBlog;
use Untitled\PageBuilder\Route;

class DoEditPost_Route extends Route
{

    /**
     * DoEditPost_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = "dashboard/blog/%VAR%/post/edit/do";
        $this->RenderView = true;
        $this->ViewFilePath = "UBlog/Dashboard/Posts/edit.html";
        $this->ComplexRoute = true;
        $this->ViewData['page_name'] = "Edit Post";
        $this->DataProcess = new UBlog_DataProcess();
    }

    public function RunDataProcess()
    {
        $post = $this->DataProcess->POST->EditPost();
        if($post != false){
            $this->ViewData['result'] = true;
            $this->ViewData['post'] = $post;
        }

        $this->ViewData['blog'] = $this->Params[0];
        $this->ViewData['all_posts'] = UBlog::GetPostsFromBlog($this->Params[0]);
    }


}