<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 11:06
 */

namespace System\Libraries\UBlog\DataProcesses;


use Application\Config\Twig_Config;
use System\Libraries\UBlog\Models\Blogs\Blog;
use System\Libraries\UBlog\UBlog;
use System\Libraries\UWebAdmin\Config\UWA_Config;
use System\Libraries\UWebAdmin\UWA;
use Untitled\Libraries\Input\Input;
use Untitled\Libraries\Input\Sanitiser\Sanitiser;
use Untitled\PageBuilder\DataProcess;

class Blog_DataProcess extends DataProcess
{

    /**
     * @param Blog $blog the blog to add
     * @return null|Blog
     */
    public function AddBlog($blog = null){
        if(is_null($blog)){

            $blog = new Blog();

            $blog->Name = Sanitiser::String(Input::Post("name"));
            $blog->Description = Sanitiser::String(Input::Post("desc"));

        }

        $blog->Insert();

        UWA_Config::$MENU_LINKS = [];
        UWA::Start();
        UBlog::Start();
        UWA::ConvertGlobalDataToTwigGlobals();

        return $blog;
    }

    /**
     * @param Blog $blog the blog to update
     * @return null|Blog
     */
    public function EditBlog($blog = null){
        if(is_null($blog)){

            $blog = new Blog(Sanitiser::Int(Input::Post("ID")));

            $blog->Name = Sanitiser::String(Input::Post("name"));
            $blog->Description = Sanitiser::String(Input::Post("desc"));

        }

        $blog->Save();

        UWA_Config::$MENU_LINKS = [];
        UWA::Start();
        UBlog::Start();
        UWA::ConvertGlobalDataToTwigGlobals();

        return $blog;
    }

    /**
     * @param Blog $blog the blog to delete
     * @return null|Blog
     */
    public function DeleteBlog($blog = null){
        if(is_null($blog)){
            $blog = new Blog(Sanitiser::Int(Input::Post("selected_blog")));
        }

        $blog->Delete();

        UWA_Config::$MENU_LINKS = [];
        Twig_Config::$GLOBAL_DATA['uwa_dashboard_menu'] = [];
        UWA::Start();
        UBlog::Start();
        UWA::ConvertGlobalDataToTwigGlobals();

        return $blog;
    }

}