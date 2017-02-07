<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 26/01/2017
 * Time: 12:07
 */

namespace System\Libraries\UWebAdmin\DataProcesses\Admin;


use System\Libraries\UWebAdmin\Models\Users\Role;
use System\Libraries\UWebAdmin\Models\Users\User;
use System\Libraries\UWebAdmin\Models\Users\UserAddress;
use System\Libraries\UWebAdmin\Models\Users\UserPhoneNumber;
use System\Libraries\UWebAdmin\Models\Users\UserRole;
use Untitled\Libraries\Input\Input;
use Untitled\Libraries\Input\Sanitiser\Sanitiser;
use Untitled\Libraries\Session\Session;
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
     * @return User
     */
    public function EditUser($User = null){
        if(is_null($User)){
            $id = Sanitiser::Number(Input::Post("ID"));

            $User = new User($id);

            $User->Username = Sanitiser::String(Input::Post("username"));
            if(Input::Post("password") && Input::Post("cpassword") == Input::Post("password")){
                $User->Password = password_hash(Sanitiser::String(Input::Post("password")), PASSWORD_BCRYPT);
            }
            $User->Email = Sanitiser::Email(Input::Post("email"));
            $User->Name = Sanitiser::String(Input::Post("name"));
            $User->DisplayName = $User->Name;

            $address = new UserAddress($User->Id);
            $address->Line1 = Sanitiser::String(Input::Post("line1"));
            $address->Line2 = Sanitiser::String(Input::Post("line2"));
            $address->City = Sanitiser::String(Input::Post("city"));
            $address->Country = Sanitiser::String(Input::Post("country"));
            $address->Zip = Sanitiser::String(Input::Post("zip"));

            $phone = new UserPhoneNumber($User->Id);
            $phone->Number = Sanitiser::String(Input::Post("phone_number"));

            if(Input::Post("role") != false ){
                $role = new UserRole($User->Id);
                $role->Role = new Role(Sanitiser::Int(Input::Post("role")));
                $User->Role = $role;
            }

            $User->Address = $address;
            $User->PhoneNumber = $phone;
        }

        $User->Save();
        return $User;
    }

    /**
     * @param $User User - Delete a user
     * @return User
     */
    public function DeleteUser($User = null){
        if(is_null($User)){
            $id = Sanitiser::Number(Input::Post("selected-user"));

            $User = new User($id);
        }

        $User->Delete();
        return $User;
    }

    /**
     * @param $UserRole UserRole - Change a users role
     */
    public function ChangeRole($UserRole){
        $UserRole->Save();
    }

    /**
     * Update user account
     * @param null $User
     * @return null|User
     */
    public function UpdateMyAccount($User = null){
        if(is_null($User)){
            $User = new User(Session::Get("user")['Id']);

            $User->Username = Sanitiser::String(Input::Post("username"));
            if(Input::Post("password") && Input::Post("cpassword") == Input::Post("password")){
                $User->Password = password_hash(Sanitiser::String(Input::Post("password")), PASSWORD_BCRYPT);
            }
            $User->Email = Sanitiser::Email(Input::Post("email"));
            $User->Name = Sanitiser::String(Input::Post("name"));
            $User->DisplayName = $User->Name;

            $address = new UserAddress($User->Id);
            $address->Line1 = Sanitiser::String(Input::Post("line1"));
            $address->Line2 = Sanitiser::String(Input::Post("line2"));
            $address->City = Sanitiser::String(Input::Post("city"));
            $address->Country = Sanitiser::String(Input::Post("country"));
            $address->Zip = Sanitiser::String(Input::Post("zip"));

            $phone = new UserPhoneNumber($User->Id);
            $phone->Number = Sanitiser::String(Input::Post("phone_number"));

            if(Input::Post("role") != false ){
                $role = new UserRole($User->Id);
                $role->Role = new Role(Sanitiser::Int(Input::Post("role")));
                $User->Role = $role;
            }

            $User->Address = $address;
            $User->PhoneNumber = $phone;
        }

        $User->Save();



        return $User;
    }

}