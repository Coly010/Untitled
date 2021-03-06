<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 03:51
 */

namespace System\Libraries\UBlog\Pages\Dashboard\Routes\Post;


use Untitled\PageBuilder\Route;

class NewPost_Route extends Route
{

    /**
     * NewPost_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = "dashboard/blog/%VAR%/post/new";
        $this->RenderView = true;
        $this->ViewFilePath = "UBlog/Dashboard/Posts/add.html";
        $this->ComplexRoute = true;
        $this->ViewData['page_name'] = "New Post";
    }

    public function RunDataProcess()
    {
        $this->ViewData['blog'] = $this->Params[0];
    }


}