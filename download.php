<?php
require_once('class/setup.php');
$smarty = new smartySetup(array(),FALSE);

//echo "<pre>".print_r($_SERVER['QUERY_STRING'], 1)."</pre>";
if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {
    $fix = urldecode($_SERVER['QUERY_STRING']);
    //$path = $smarty->url;
    $path = getcwd();
    $full_path = $path.'/' . $fix;

    if(!file_exists($full_path)){
        echo "<html><body><BR><B>ERROR:</B> File not found.</body></html>";
        exit;
    }
    else if ($fd = fopen($full_path, "r")) {

        $fsize = filesize($full_path);
        $path_parts = pathinfo($full_path);
        $ext = strtolower($path_parts["extension"]);
         //*echo $path_parts["basename"];
        switch ($ext) {
            case "pdf":
                header('Content-disposition: attachment; filename='.$path_parts["basename"]);
                header('Content-type: application/pdf');
                
//                header("Content-type: application/pdf"); // add here more headers for diff. extensions
//                header("Content-Disposition: attachment; filename=\"" . $path_parts["basename"] . "\""); // use 'attachment' to force a download
                break;
            default;
                header("Content-type: application/octet-stream");
                header("Content-Disposition: filename=\"" . $path_parts["basename"] . "\"");
        }

        readfile($full_path);
        fclose($fd);
    }
    else {
        echo "<html><body><BR><B>ERROR:</B> Can not open file.</body></html>";
        exit;
    }
    
}
exit;


?>