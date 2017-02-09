<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 10:34
 */

namespace System\Libraries\UBlog\Pages\Dashboard\Routes\Blog;


use System\Libraries\UBlog\Config\UBlog_RouteStrings;
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
        // TODO: Implement RunDataProcess() method.
    }


}