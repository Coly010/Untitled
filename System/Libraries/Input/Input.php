<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 04/01/2017
 * Time: 11:43
 */

namespace Untitled\Libraries\Input;

use System\Helpers\Arrays\Array_Helper;
use System\Libraries\UGallery\UGallery;
use Untitled\Libraries\Session\Session;

class Input
{

    /**
     * Return a value that was sent with a GET request
     * @param $key - Key of the value
     * @return bool/mixed - the value or false if invalid key
     */
    public static function Get($key) {
        return isset($_GET[$key]) ? $_GET[$key] : false;
    }

    /**
     * Return a value that was sent with a POST request
     * @param $key - Key of the value
     * @return bool/mixed - the value or false if invalid key
     */
    public static function Post($key) {
        return isset($_POST[$key]) ? $_POST[$key] : false;
    }

    /**
     * Return the files uploaded
     * @param $key - Files uploaded key
     * @param array $exts - accepted extensions
     * @param string $uploadPath - the upload path to put the file
     * @return bool|array - the location of where it was uploaded or false
     */
    public static function File($key, $exts = null, $uploadPath = "./uploads/") {
        header('Content-Type: text/plain; charset=utf-8');

        if(is_null($exts)){
            $exts = UGallery::$MIME_TYPES;
        }

        try {

            if(!isset($_FILES[$key])){
                throw new \RuntimeException("No files were uploaded.");
            }

            $files = Array_Helper::ReorderFileArray($_FILES[$key]);

            $UploadedFiles = [];

            foreach($files as $file){
                if(is_array($file['error'])){
                    throw new \RuntimeException("Invalid Parameters");
                }

                switch($file['error']){
                    case UPLOAD_ERR_OK :
                        break;
                    case UPLOAD_ERR_NO_FILE :
                        throw new \RuntimeException("No file sent");
                    case UPLOAD_ERR_INI_SIZE :
                    case UPLOAD_ERR_FORM_SIZE :
                        throw new \RuntimeException("Exceeded Filesize limit");
                    default :
                        throw new \RuntimeException('Unknown errors.');

                }

                if($file['size'] > UPLOAD_SIZE){
                    throw new \RuntimeException("File exceeds max file size");
                }

                $info = new \finfo(FILEINFO_MIME_TYPE);
                $ext = array_search($info->file($file['tmp_name']), $exts, true);

                if(false === $ext){
                    throw new \RuntimeException("Invalid file format");
                }

                // create directory if it does not exists
                if(!is_dir($uploadPath)){
                    mkdir($uploadPath, 0777, true);
                }

                // check for trailing slash
                if(substr($uploadPath, -1) != DIRECTORY_SEPARATOR){
                    $uploadPath .= DIRECTORY_SEPARATOR;
                }

                $location = sprintf($uploadPath."%s.%s", sha1_file($file['tmp_name']), $ext);
                if(!move_uploaded_file($file['tmp_name'], $location)){
                    throw new \RuntimeException("Failed to move uploaded file.");
                }

                if(@is_array(getimagesize($location)))
                {
                    Session::Add("UploadedImage", true);
                }

                if($location[0] == "."){
                    $location = substr($location, 1);
                }

                $UploadedFiles[] = $location;
            }

            Session::Add("UploadedFilesLocations", $UploadedFiles);

            return $UploadedFiles;

        } catch(\RuntimeException $e) {
            echo "File Upload Error - ". $e->getMessage();
            return false;
        }
    }

}