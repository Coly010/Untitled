<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 16/02/2017
 * Time: 14:32
 */

namespace System\Libraries\UGallery\Pages\Routes\Upload;


use Untitled\Libraries\Session\Session;
use Untitled\PageBuilder\Route;

class GetUploadProgress_Route extends Route
{


    /**
     * GetUploadProgress_Route constructor.
     */
    public function __construct()
    {
        $this->Request = "upload/progress/%VAR%";
        $this->ComplexRoute = true;
        $this->RenderView = false;
    }

    /**
     * Run data process
     */
    public function RunDataProcess()
    {
        $formName = $this->Params[0];

        Session::Start();

        $key = ini_get("session.upload_progress.prefix") . $formName;

        $returnData = ["error" => false, "error_msg" => "", "done" => false];

        if(Session::Get($key)){
            if(Session::Get($key)["content_length"] > UPLOAD_SIZE){
                $returnData['error'] = true;
                $returnData['error_msg'] = "Upload file size exceeded.";
                $_SESSION[$key]["cancel_upload"] = true;
            }

            $current = Session::Get($key)["bytes_processed"];
            $total = Session::Get($key)["content_length"];

            $returnData['progress'] = $current < $total ? ceil($current / $total * 100) : 100;
        } else {
            $returnData['progress'] = 100;
            $returnData['done'] = true;
            $returnData['files'] = Session::Get("UploadedFilesLocations");
            $returnData['image'] = Session::Get("UploadedImage");
            unset($_SESSION['UploadedFilesLocations']);
            unset($_SESSION['UploadedImage']);
        }
        echo json_encode($returnData);
    }


}