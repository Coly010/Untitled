<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 09/02/2017
 * Time: 19:57
 */

namespace System\Libraries\UBlog\DataProcesses;

use Untitled\PageBuilder\DataProcess;

class UBlog_DataProcess extends DataProcess
{

    public $BLOG, $POST;

    public function __construct()
    {
        parent::__construct();

        $this->BLOG = new Blog_DataProcess();
        $this->POST = new Post_DataProcess();
    }

}