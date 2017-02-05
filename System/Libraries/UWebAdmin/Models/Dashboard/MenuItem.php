<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 04/02/2017
 * Time: 10:12
 */

namespace System\Libraries\UWebAdmin\Models\Dashboard;


use System\Libraries\UWebAdmin\Models\Interfaces\IObjArray;

class MenuItem implements IObjArray
{

    //region Properties

    /**
     * @var boolean determines whether the item is actually a link or just a heading
     */
    public $Header = false;

    /**
     * @var string the name of the link
     */
    public $Link = "";

    /**
     * @var string the url of the link
     */
    public $Url = "";

    //endregion

    //region Constructors

    /**
     * MenuItem constructor.
     * @param bool $Header
     * @param string $Link
     * @param string $Url
     */
    public function __construct($Link, $Url, $Header = false)
    {
        $this->Header = $Header;
        $this->Link = $Link;
        $this->Url = $Url;
    }

    //endregion

    //region IObjArray method

    /**
     * @return array Object as Array
     */
    public function ToArray()
    {
        return get_object_vars($this);
    }

    //endregion

}