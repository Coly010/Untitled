<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 04:15
 */

namespace System\Libraries\UBlog\Pages\Dashboard;


use System\Libraries\UBlog\Pages\Dashboard\Routes\Blog\AddBlog_Route;
use System\Libraries\UBlog\Pages\Dashboard\Routes\Blog\DeleteBlog_Route;
use System\Libraries\UBlog\Pages\Dashboard\Routes\Blog\DoAddBlog_Route;
use System\Libraries\UBlog\Pages\Dashboard\Routes\Blog\DoDeleteBlog_Route;
use System\Libraries\UBlog\Pages\Dashboard\Routes\Blog\DoEditBlog_Route;
use System\Libraries\UBlog\Pages\Dashboard\Routes\Blog\EditBlog_Route;
use System\Libraries\UBlog\Pages\Dashboard\Routes\Post\DeletePost_Route;
use System\Libraries\UBlog\Pages\Dashboard\Routes\Post\DoDeletePost_Route;
use System\Libraries\UBlog\Pages\Dashboard\Routes\Post\DoEditPost_Route;
use System\Libraries\UBlog\Pages\Dashboard\Routes\Post\DoNewPost_Route;
use System\Libraries\UBlog\Pages\Dashboard\Routes\Post\EditPost_Route;
use System\Libraries\UBlog\Pages\Dashboard\Routes\Post\NewPost_Route;
use Untitled\PageBuilder\Page;

class BlogDashboard_Page extends Page
{

    public function __construct()
    {
        parent::__construct();

        // BLOGS
        $this->AddRoute(new AddBlog_Route());
        $this->AddRoute(new DoAddBlog_Route());
        $this->AddRoute(new EditBlog_Route());
        $this->AddRoute(new DoEditBlog_Route());
        $this->AddRoute(new DeleteBlog_Route());
        $this->AddRoute(new DoDeleteBlog_Route());

        //POSTS
        $this->AddRoute(new NewPost_Route());
        $this->AddRoute(new DoNewPost_Route());
        $this->AddRoute(new EditPost_Route());
        $this->AddRoute(new DoEditPost_Route());
        $this->AddRoute(new DeletePost_Route());
        $this->AddRoute(new DoDeletePost_Route());

    }

}