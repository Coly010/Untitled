<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 10:34
 */

namespace System\Libraries\UBlog\Pages\Dashboard\Routes\Blog;


use System\Libraries\UBlog\Config\UBlog_RouteStrings;
use System\Libraries\UBlog\Models\Blogs\Blog;
use Untitled\Libraries\Input\Input;
use Untitled\Libraries\Input\Sanitiser\Sanitiser;
use Untitled\PageBuilder\Route;

class GetBlog_Route extends Route
{

    /**
     * EditBlog_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = UBlog_RouteStrings::$GET_BLOG;
        $this->RenderView = false;
    }

    public function RunDataProcess()
    {
        $this->ViewData['found_blog'] = new Blog(Sanitiser::Int(Input::Post("blog_id")));
    }


}