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

class EditBlog_Route extends Route
{

    /**
     * EditBlog_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = UBlog_RouteStrings::$EDIT_BLOG;
        $this->RenderView = true;
        $this->ViewFilePath = "UBlog/Dashboard/Blogs/edit.html";
    }

    public function RunDataProcess()
    {
        // TODO: Implement RunDataProcess() method.
    }


}