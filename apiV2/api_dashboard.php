<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/notes.php');
require_once('class/leave.php');
require_once('class/mail.php');
require_once('class/support_new.php');
require_once('class/equipment.php');

$smarty 	= new smartySetup(array("user.xml"), FALSE);
$leave 		= new leave();
$notes 		= new notes();
$mail 		= new mail();
$support 	= new support();
$obj_equipment = new equipment();

$obj = new stdClass();
$obj->session_status = $session_check;

/*$notes_list 		= $notes->get_all_notes();
$unread_notes 		= $notes->get_unread_note(); 
$updated_unread_notes		= $notes->get_all_unread_notes($notes_list,$unread_notes);
$obj->unread_notes_count 	= count($updated_unread_notes);*/
$obj->unread_notes_count 	= (int) $notes->get_unread_note_count();

$running_slot_data 		= $leave->get_running_tasks($_SESSION['user_id']);
$obj->running_count 	= !empty($running_slot_data) ? 1 : 0;

// $user_id 			= trim($_REQUEST['user']);
$user_id 				= $_SESSION['user_id'];
$unread_mail 			= $mail->get_all_unread_mail($user_id);
$obj->unread_mail_count = count($unread_mail);

$obj->open_ticket_count = (int) $support->get_ticket_open_count();
$obj->document_count = 0;

$documents_array = $obj_equipment->get_public_document_archive();
foreach ($documents_array as $document) {
  if(!(int)$document['signed_id']) {
    $obj->document_count++;
  }
}

$obj->cookies = $_COOKIE;
echo json_encode($obj);
?>