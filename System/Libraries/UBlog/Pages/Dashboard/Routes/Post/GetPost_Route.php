<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 10/02/2017
 * Time: 21:47
 */

namespace System\Libraries\UBlog\Pages\Dashboard\Routes\Post;

use System\Libraries\UBlog\Models\Blogs\Post;
use Untitled\Libraries\Input\Input;
use Untitled\Libraries\Input\Sanitiser\Sanitiser;
use Untitled\PageBuilder\Route;

class GetPost_Route extends Route
{

    public function __construct()
    {
        parent::__construct();

        $this->Request = "dashboard/blog/%VAR%/post/get";
        $this->ComplexRoute = true;
        $this->RenderView = false;
    }

    public function RunDataProcess()
    {
        $this->ViewData['found_post'] = new Post(Sanitiser::Int(Input::Post("post_id")));
    }


}