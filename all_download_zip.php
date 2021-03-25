<?php
/**
 * Author: Shamsu
 * for: download all note attachments by note ID as zip formate 
 * last edited: 08-04-2013
*/

require_once('class/setup.php');
$smarty = new smartySetup(array("messages.xml","month.xml","button.xml","notes.xml", "customer.xml"), FALSE);
if(!isset($_SESSION['user_id'])){
	header("Location: " . $smarty->url . "");
        exit;
}
require_once('class/notes.php');
//require_once('class/user.php');
require_once('configs/config.inc.php');
require_once('class/create_zip.php');

$params = explode('&', $_SERVER['QUERY_STRING']);
$username = $params[0];
$note_id = $params[1];

$notes = new notes();
//$user = new user();
if($note_id != ''){
        //get all notes for check is accessible of this note
        $all_notes = $notes->get_all_notes();
        $access_flag = FALSE;
        if(!empty($all_notes)){
            foreach($all_notes as $this_note){
                if($this_note['id'] == $note_id)
                    $access_flag = TRUE;
            }
        }
        if(!$access_flag){
            echo "<html><body><BR><B>ERROR:</B> ".$smarty->translate['permission_denied'] ."</body></html>";
            exit;
        }
        
        $notes_detail = $notes->get_note_detail($note_id);
        $attached = explode(",",$notes_detail[0]['attachment']);
        error_reporting(E_ALL);
        $files_to_zip = array();
        $get_CompanyName = $notes->get_company_name($_SESSION['company_id']);
        $app_dir = getcwd();
        chdir($app_dir."/".$get_CompanyName."/notes/attachment/");
        foreach($attached as $fileName){
                $files_to_zip[] = $fileName;
        }
       $name =  'note_attachment'.strtotime(date('Y-m-d H:i:s')).'.zip';
       create_zip($files_to_zip,"attachments",false,$name);
//        exit();
//       echo $name;
       forceDownload($name);
       @unlink($app_dir."/".$get_CompanyName."/notes/attachment/".$name);
}else{
    header("Location: " . $smarty->url . "notes/list/");exit;
}

 function forceDownload($archiveName) {
        if(ini_get('zlib.output_compression')) {
            ini_set('zlib.output_compression', 'Off');
        }
        // Security checks
        if( $archiveName == "" ) {
            echo "<html><body><BR><B>ERROR:</B> The download file was NOT SPECIFIED.</body></html>";
            exit;
        }elseif ( !file_exists( $archiveName ) ) {
//            echo "<html><body><BR><B>ERROR:</B> File not found.</body></html>";
            echo "<html><body><BR><B>ERROR:</B> Attachments not found.</body></html>";
            exit;
        }

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=".basename($archiveName).";" );
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".filesize($archiveName));
        readfile("$archiveName");
}
//exit;
?>