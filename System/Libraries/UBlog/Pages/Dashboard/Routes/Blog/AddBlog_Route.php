<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 03:48
 */

namespace System\Libraries\UBlog\Pages\Dashboard\Routes\Blog;


use System\Libraries\UBlog\Config\UBlog_RouteStrings;
use Untitled\PageBuilder\Route;

class AddBlog_Route extends Route
{

    /**
     * DoDeletePost_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = UBlog_RouteStrings::$ADD_BLOG;
        $this->RenderView = true;
        $this->ViewFilePath = "UBlog/Dashboard/Blogs/add.html";
        $this->ViewData['page_name'] = "Add Blog";
    }

    public function RunDataProcess()
    {
    }


}