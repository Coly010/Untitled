<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 13/02/2017
 * Time: 19:59
 */

namespace System\Libraries\UGallery\Models\Gallery;


class Photo extends Media
{

    //region Constructors

    /**
     * Photo constructor.
     * @param null $id id of the photo
     */
    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    //endregion

}