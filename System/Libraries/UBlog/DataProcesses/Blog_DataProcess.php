<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 08/02/2017
 * Time: 11:06
 */

namespace System\Libraries\UBlog\DataProcesses;


use System\Libraries\UBlog\Models\Blogs\Blog;
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
        return $blog;
    }

    /**
     * @param Blog $blog the blog to delete
     * @return null|Blog
     */
    public function DeleteBlog($blog = null){
        if(is_null($blog)){
            $blog = new Blog(Sanitiser::Int(Input::Post("ID")));
        }

        $blog->Delete();
        return $blog;
    }

}