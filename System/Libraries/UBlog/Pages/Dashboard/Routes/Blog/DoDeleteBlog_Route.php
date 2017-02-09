<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 03:49
 */

namespace System\Libraries\UBlog\Pages\Dashboard\Routes\Blog;


use System\Libraries\UBlog\Config\UBlog_RouteStrings;
use System\Libraries\UBlog\DataProcesses\UBlog_DataProcess;
use System\Libraries\UBlog\UBlog;
use Untitled\PageBuilder\Route;

class DoDeleteBlog_Route extends Route
{

    /**
     * DoDeleteBlog_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = UBlog_RouteStrings::$DELETE_BLOG."/do";
        $this->RenderView = true;
        $this->ViewFilePath = "UBlog/Dashboard/Blogs/delete.html";
        $this->DataProcess = new UBlog_DataProcess();
        $this->ViewData['page_name'] = "Delete Blog";
    }

    public function RunDataProcess()
    {
        $blog = $this->DataProcess->BLOG->DeleteBlog();
        if($blog != false){
            $this->ViewData['result'] = true;
            $this->ViewData['blog'] = $blog;
        }

        $this->ViewData['all_blogs'] = UBlog::GetBlogs();
    }


}