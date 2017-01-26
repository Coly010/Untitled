<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 26/01/2017
 * Time: 12:07
 */

namespace System\Libraries\UWebAdmin\DataProcesses\Admin;


use System\Libraries\UWebAdmin\Config\UWA_Config;
use Untitled\PageBuilder\DataProcess;

class UserAdmin_DataProcess extends DataProcess
{

    public function AddUser($User){
        $User->Insert();
    }

    public function EditUser($User){
        $User->Save();
    }

    public function DeleteUser($User){
        $User->Delete();
    }

    public function ChangeRole($UserRole){
        $UserRole->Save();
    }

}