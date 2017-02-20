<?php
/**
 * Created by PhpStorm.
 * User: Colum
 * Date: 16/02/2017
 * Time: 12:47
 */

namespace System\Helpers\Arrays;


class Array_Helper
{

    /**
     * Reorder the files array into an array with better structure
     * @param array $files uploaded files
     * @return array reordered array
     */
    public static function ReorderFileArray($files){

        $fileArray = [];
        $fileCount = count($files['name']);
        $fileKeys = array_keys($files);

        for($i = 0; $i < $fileCount; $i++){
            foreach($fileKeys as $key){
                $fileArray[$i][$key] = $files[$key][$i];
            }
        }

        return $fileArray;
    }

}