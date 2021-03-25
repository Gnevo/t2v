<?php
session_start();
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('class/setup.php');
require_once('class/notes.php');
require_once('class/leave.php');

$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();
$notes = new notes();

/*$data = $notes->get_all_notes($_REQUEST['year'],$_REQUEST['month']);
//$obj->count = sizeof($data);
$obj->count = count($data);*/
$obj = new stdClass();
$notes_list = $notes->get_all_notes();
$unread_notes = $notes->get_unread_note(); 
$updated_unread_notes=$notes->get_all_unread_notes($notes_list,$unread_notes);
$obj->count = count($updated_unread_notes);
$obj->running_count = 0;
$data = $leave->get_running_tasks($_SESSION['user_id']);
if(!empty($data)){
    $obj->running_count = 1;
}

//header("content-type: text/javascript");
echo json_encode($obj);
?>