<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 03:51
 */

namespace System\Libraries\UBlog\Pages\Dashboard\Routes\Post;


use Untitled\PageBuilder\Route;

class EditPost_Route extends Route
{

    /**
     * EditPost_Route constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->Request = "dashboard/blog/%VAR%/post/edit";
        $this->RenderView = true;
        $this->ViewFilePath = "UBlog/Dashboard/Posts/edit.html";
        $this->ComplexRoute = true;
    }

    public function RunDataProcess()
    {
        // TODO: Implement RunDataProcess() method.
    }


}