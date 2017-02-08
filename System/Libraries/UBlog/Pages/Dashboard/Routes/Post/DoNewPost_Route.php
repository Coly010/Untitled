<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 03:51
 */

namespace System\Libraries\UBlog\Pages\Dashboard\Routes\Post;


use Untitled\PageBuilder\Route;

class DoNewPost_Route extends Route
{

    /**
     * DoNewPost_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = "dashboard/blog/%VAR%/post/new/do";
        $this->RenderView = true;
        $this->ViewFilePath = "UBlog/Dashboard/Posts/add.html";
    }

    public function RunDataProcess()
    {
        // TODO: Implement RunDataProcess() method.
    }


}