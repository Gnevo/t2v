<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/leave.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();

$obj = new stdClass();
$obj->session_status = $session_check;
$leave->userid = $_REQUEST['userid'];
$leave->mreq_id = $_REQUEST['mreq_id'];
$leave->update_message_status($_REQUEST['status'],$_REQUEST['message_id']);
$obj->success = "0";
echo json_encode($obj);
?>