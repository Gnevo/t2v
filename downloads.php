<?php
require_once('class/setup.php');
$smarty = new smartySetup(array(),FALSE);

if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {

    $path = $smarty->url;
    $full_path = $path . $_SERVER['QUERY_STRING'];
    echo $full_path;
    if ($fd = fopen($full_path, "r")) {

        $fsize = filesize($full_path);
        $path_parts = pathinfo($full_path);
        $ext = strtolower($path_parts["extension"]);
        switch ($ext) {
            case "pdf":
                header("Content-type: application/pdf"); // add here more headers for diff. extensions
                header("Content-Disposition: attachment; filename=\"" . $path_parts["basename"] . "\""); // use 'attachment' to force a download
                break;
            default;
                header("Content-type: application/octet-stream");
                header("Content-Disposition: filename=\"" . $path_parts["basename"] . "\"");
        }
        header("Content-length: $fsize");
        header("Cache-control: private"); //use this to open files directly
        while (!feof($fd)) {
            $buffer = fread($fd, 2048);
            echo $buffer;
        }
    }
    fclose($fd);
}
exit;
?>
