<?php
/**
 * Author: Shamsu
 * for: download single note attachment by note ID
 * last edited: 08-04-2013
*/

require_once('class/setup.php');
$smarty = new smartySetup(array("messages.xml","button.xml","support.xml", "customer.xml"),FALSE);
if(!isset($_SESSION['user_id'])){
	header("Location: " . $smarty->url . "");
        exit;
}

require_once('class/support_new.php');
require_once('configs/config.inc.php');

$support = new support();

$params = explode('&', $_SERVER['QUERY_STRING']);
$company_id = $params[0];
$filename = $params[1];

if($filename == ''){
    echo "<html><body><BR><B>ERROR:</B> File not found.</body></html>";
    exit;
}

//Set the time out
set_time_limit(0);
$company_data = $support->get_companies($company_id);
$company_upload_dir = $company_data[0]['upload_dir'];
$app_dir = getcwd(); 
$file_path = $app_dir."/" . $company_upload_dir . "/tickets/attachment/".$filename;

if(!file_exists($file_path)){
    echo "<html><body><BR><B>ERROR:</B> File not found.</body></html>";
    exit;
}
//Call the download function with file path,file name and file type
output_file($file_path, $filename, '');
exit;

function output_file($file, $name, $mime_type = '') {
    /*
      This function takes a path to a file to output ($file),  the filename that the browser will see ($name) and  the MIME type of the file ($mime_type, optional).
     */
    $size = filesize($file);
    $name = rawurldecode($name);
    /* Figure out the MIME type | Check in array */
    $known_mime_types = array(
        "pdf" => "application/pdf",
        "txt" => "text/plain",
        "html" => "text/html",
        "htm" => "text/html",
        "exe" => "application/octet-stream",
        "zip" => "application/zip",
        "doc" => "application/msword",
        "xls" => "application/vnd.ms-excel",
        "ppt" => "application/vnd.ms-powerpoint",
        "gif" => "image/gif",
        "png" => "image/png",
        "jpeg" => "image/jpg",
        "jpg" => "image/jpg",
        "php" => "text/plain"
    );

    if ($mime_type == '') {
        $file_extension = strtolower(substr(strrchr($file, "."), 1));
        if (array_key_exists($file_extension, $known_mime_types)) {
            $mime_type = $known_mime_types[$file_extension];
        } else {
            $mime_type = "application/force-download";
        };
    };

    //turn off output buffering to decrease cpu usage
    @ob_end_clean();

    // required for IE, otherwise Content-Disposition may be ignored
    /* if(ini_get('zlib.output_compression'))
      ini_set('zlib.output_compression', 'Off'); */

    header('Content-Type: ' . $mime_type);
    header('Content-Disposition: attachment; filename="' . $name . '"');
    header("Content-Transfer-Encoding: binary");
    header('Accept-Ranges: bytes');

    /* The three lines below basically make the 
      download non-cacheable */
    header("Cache-control: private");
    header('Pragma: private');
    header("Expires: Tue, 17 Dec 2013 05:00:00 GMT");

    // multipart-download and download resuming support
    if (isset($_SERVER['HTTP_RANGE'])) {
        list($a, $range) = explode("=", $_SERVER['HTTP_RANGE'], 2);
        list($range) = explode(",", $range, 2);
        list($range, $range_end) = explode("-", $range);
        $range = intval($range);
        if (!$range_end) {
            $range_end = $size - 1;
        } else {
            $range_end = intval($range_end);
        }

        $new_length = $range_end - $range + 1;
        header("HTTP/1.1 206 Partial Content");
        header("Content-Length: $new_length");
        header("Content-Range: bytes $range-$range_end/$size");
    } else {
        $new_length = $size;
        header("Content-Length: " . $size);
    }


    $chunksize = 1 * (1024 * 1024); //you may want to change this
    $bytes_send = 0;
    if ($file = fopen($file, 'r')) {
        if (isset($_SERVER['HTTP_RANGE']))
            fseek($file, $range);

        while (!feof($file) && (!connection_aborted()) && ($bytes_send < $new_length)) {
            $buffer = fread($file, $chunksize);
            print($buffer); //echo($buffer); // can also possible
            flush();
            $bytes_send += strlen($buffer);
        }
        fclose($file);
    }else
    //If no permissiion
        die('Error - can not open file.');
    //die
    die();
}
?>