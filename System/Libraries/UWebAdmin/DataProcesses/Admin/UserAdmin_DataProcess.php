<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 26/01/2017
 * Time: 12:07
 */

namespace System\Libraries\UWebAdmin\DataProcesses\Admin;


use Untitled\PageBuilder\DataProcess;

class UserAdmin_DataProcess extends DataProcess
{

    /**
     * @param $User User - Add a user
     */
    public function AddUser($User){
        $User->Insert();
    }

    /**
     * @param $User User - Edit a user
     */
    public function EditUser($User){
        $User->Save();
    }

    /**
     * @param $User User - Delete a user
     */
    public function DeleteUser($User){
        $User->Delete();
    }

    /**
     * @param $UserRole UserRole - Change a users role
     */
    public function ChangeRole($UserRole){
        $UserRole->Save();
    }

}