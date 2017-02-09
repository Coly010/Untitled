<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 03:48
 */

namespace System\Libraries\UBlog\Pages\Dashboard\Routes\Blog;


use System\Libraries\UBlog\Config\UBlog_RouteStrings;
use System\Libraries\UBlog\DataProcesses\UBlog_DataProcess;
use Untitled\PageBuilder\Route;

class DoAddBlog_Route extends Route
{

    /**
     * DoAddBlog_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = UBlog_RouteStrings::$ADD_BLOG."/do";
        $this->RenderView = true;
        $this->ViewFilePath = "UBlog/Dashboard/Blogs/add.html";
        $this->DataProcess = new UBlog_DataProcess();
        $this->ViewData['page_name'] = "Add Blog";
    }

    public function RunDataProcess()
    {
       $blog = $this->DataProcess->BLOG->AddBlog();
        if($blog != false){
            $this->ViewData['result'] = true;
            $this->ViewData['blog'] = $blog;
        }
    }


}