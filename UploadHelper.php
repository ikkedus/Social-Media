<?php

/**
 * Created by PhpStorm.
 * User: martin
 * Date: 5/7/2017
 * Time: 1:56 PM
 */
class UploadHelper
{
    public static function GeneratePath($targetDir){
        if(isset($_POST["submit"])) {
        $path=$targetDir .'/'. basename($_FILES["inputFile"]["name"]);
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $actual_name = pathinfo(basename($_FILES["inputFile"]["name"],PATHINFO_FILENAME));
        $original_name = $actual_name;
        $extension = pathinfo(basename($_FILES["inputFile"]["name"], PATHINFO_EXTENSION));
        $i = 1;
        while(file_exists($targetDir.'/'.$actual_name["basename"].".".$extension["extension"]))
        {
            $actual_name = (string)$original_name.$i;
            $path= $targetDir .'/'.$actual_name.".".$extension;
            $i++;
        }
        return $path;
        }
    }
    public static function UploadFile($path,&$error){
        $error = "";

        if(isset($_POST["submit"])) {
            if (file_exists($path)) {
                $error = "file exists";
            }
            if ($error != "") {
                return false;
            } else {
                if (move_uploaded_file($_FILES["inputFile"]["tmp_name"], $path)) {
                    return true;
                } else {
                    $error = "Sorry, there was an error uploading your file.";
                }
            }
        }
        return false;
    }
}