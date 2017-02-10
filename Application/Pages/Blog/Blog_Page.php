<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 10/02/2017
 * Time: 23:08
 */

namespace Application\Pages\Blog;


use Application\Pages\Blog\Routes\BlogHome_Route;
use Untitled\PageBuilder\Page;

class Blog_Page extends Page
{

    public function __construct()
    {
        parent::__construct();

        $this->AddRoute(new BlogHome_Route());
    }

}