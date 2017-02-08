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
    }

    public function RunDataProcess()
    {
        // TODO: Implement RunDataProcess() method.
    }


}