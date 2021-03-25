<?php
/**
 * Author: Shamsudheen
 * for: Common interface for downloading existing pdf files from server
*/
require_once('class/setup.php');
require_once('class/dona.php');
require_once('configs/config.inc.php');

$smarty = new smartySetup(array("messages.xml"),FALSE);
$dona= new dona();
//global $preference;

$pdf_name = trim($_GET['name']);
$pdf_type = (isset($_GET['type']) && trim($_GET['type']) != '') ? trim($_GET['type']) : NULL;

if($pdf_name == ''){
    die($smarty->translate['file_could_not_download']);
}

$company = $dona->get_company_directory($_SESSION['company_id']);
$file_path = '';
switch ($pdf_type){
    case 1:     //fkkn report
        $file_path = "./" . $company['upload_dir'] . "/fkkn/" . $pdf_name;
        break;
    default :     //General (Certification, sick report)
        $file_path = "./" . $company['upload_dir'] . "/created_pdf_files/" . $pdf_name;
        break;
}
$filename = $pdf_name; /* Note: Always use .pdf at the end. */

if(file_exists($file_path)){
    header("Pragma: public");
    header('Content-type: '.mime_content_type($file_path));
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($file_path));
    header('Accept-Ranges: bytes');
    readfile($file_path);
}else
    print($smarty->translate['file_could_not_download']);

/*
    echo 'File not exist';
print($smarty->translate['file_could_not_download']);

header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file_path));
header('Accept-Ranges: bytes');
readfile($file_path);
header("Location: " . $preference['url'] . $company['upload_dir'] . "/created_pdf_files/" . $pdf_name);
$smarty->display('extends:layouts/dashboard.tpl|mail_list.tpl');
*/

?>