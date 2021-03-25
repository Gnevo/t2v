<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('class/setup.php');
require_once('class/notes.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$notes = new notes();

$req_year = trim($_REQUEST['year']);
$req_month = trim($_REQUEST['month']);
$sel_year   = ($req_year != "" && $req_year != "NULL" ? $req_year : NULL );
$sel_month  = ($req_month != "" && $req_month != "NULL" ? $req_month : NULL);
$breaks = array("<br />","<br>","<br/>");  
$i = 0;
$obj = array();
if($sel_year != NULL && $sel_month != NULL){
    $data = $notes->get_all_notes($sel_year, $sel_month,$_REQUEST['st'],$_REQUEST['en']);
    
    if(!empty($data)){
        foreach($data as $notes) {
   
                $notes['description'] = strip_tags(str_ireplace($breaks, "\r\n", $notes['description'])); 
                $obj[$i] = $notes;
                $i++;
        }
    }
}
else {
    //check unread year month notes
    $notes_list=$notes->get_all_notes();
    $unread_notes = $notes->get_unread_note();
    $all_unread_list=$notes->get_all_unread_notes($notes_list,$unread_notes);
    $unread_list = array_slice($all_unread_list, 0, 5);
    if(!empty($unread_list)){
        foreach($unread_list as $note) {
                $obj[$i] = $note;
                $i++;
        }
        $notes->set_as_read_notes($unread_list);
    }
//    echo "<pre>".print_r($obj, 1)."</pre>";
}
//header("content-type: text/javascript");
echo json_encode($obj);
?>