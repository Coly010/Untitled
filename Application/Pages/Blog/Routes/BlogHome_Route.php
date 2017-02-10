<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 10/02/2017
 * Time: 23:09
 */

namespace Application\Pages\Blog\Routes;


use System\Libraries\UBlog\Models\Blogs\Blog;
use Untitled\PageBuilder\Route;

class BlogHome_Route extends Route
{

    public function __construct()
    {
        parent::__construct();

        $this->Request = "blog";
        $this->RenderView = true;
        $this->ViewFilePath = "Blog/blog.html";
    }

    public function RunDataProcess()
    {
        $blog = new Blog(3);
        $this->ViewData['all_posts'] = $blog->Posts;
    }

}