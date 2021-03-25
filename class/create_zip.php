<?php
/**
 * Author: Shamsu
 * for: create a zip file for note attachments
 * last edited: 08-04-2013
*/

function create_zip($files = array(), $destination = '', $overwrite = false, $zip_filename = "") {
    //if the zip file already exists and overwrite is false, return false
    if (file_exists($destination) && !$overwrite) {
        return false;
    }
    //vars
    $valid_files = array();
    //if files were passed in...
    if (is_array($files)) {
        //cycle through each file
        foreach ($files as $file) {
            //make sure the file exists
            if (file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }
    //if we have good files...
    if (count($valid_files)) {
        //create the archive
        $zip = new ZipArchive();
        if ($zip->open($zip_filename, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        $dh = getcwd();
        //$dir = current($destination);
        $zip->addEmptyDir($destination);
        //$dh = opendir($destination); 
        //add the files
        foreach ($valid_files as $file) {
            $zip->addFile($file, $destination . "/" . $file);
        }
        //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
        $zip->close();
        //check to make sure the file exists
        return file_exists($zip_filename);
//        return file_exists($destination);
    } else {
        return false;
    }
}

?>