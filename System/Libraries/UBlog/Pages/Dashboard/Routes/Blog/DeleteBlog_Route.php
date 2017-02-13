<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 03:48
 */

namespace System\Libraries\UBlog\Pages\Dashboard\Routes\Blog;


use System\Libraries\UBlog\Config\UBlog_RouteStrings;
use System\Libraries\UBlog\UBlog;
use Untitled\PageBuilder\Route;

class DeleteBlog_Route extends Route
{

    /**
     * DoDeletePost_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = UBlog_RouteStrings::$DELETE_BLOG;
        $this->RenderView = true;
        $this->ViewFilePath = "UBlog/Dashboard/Blogs/delete.html";
        $this->ViewData['page_name'] = "Delete Blog";
    }

    public function RunDataProcess()
    {
        $this->ViewData['all_blogs'] = UBlog::GetBlogs();
    }


}