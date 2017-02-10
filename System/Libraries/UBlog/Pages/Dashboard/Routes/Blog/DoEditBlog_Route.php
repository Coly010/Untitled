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
use System\Libraries\UBlog\UBlog;
use System\Libraries\UWebAdmin\Models\Users\User;
use System\Libraries\UWebAdmin\UWA;
use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\Route;

class DoEditBlog_Route extends Route
{

    /**
     * DoEditBlog_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = UBlog_RouteStrings::$EDIT_BLOG."/do";
        $this->RenderView = true;
        $this->ViewFilePath = "UBlog/Dashboard/Blogs/edit.html";
        $this->DataProcess = new UBlog_DataProcess();
        $this->ViewData['page_name'] = "Edit Blog";
    }

    public function RunDataProcess()
    {
        $blog = $this->DataProcess->BLOG->EditBlog();
        if($blog != false){
            $this->ViewData['result'] = true;
            $this->ViewData['blog'] = $blog;

            UWA::NewActivity(new User(Session::Get("user")['Id']), Session::Get("user")['Name']. " deleted blog ". $blog->Name. ".", time());
        }

        $this->ViewData['all_blogs'] = UBlog::GetBlogs();
    }


}