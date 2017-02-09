<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 03:52
 */

namespace System\Libraries\UBlog\Pages\Dashboard\Routes\Post;


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
    }

    public function RunDataProcess()
    {
        // TODO: Implement RunDataProcess() method.
    }


}