<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/leave.php');

$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();

$row = $leave->get_leave_request_details_by_id($_REQUEST["leave_id"]);
$tmp = explode(",",$row["read"]);
$remaining = $row['reciever_ids'];

if(sizeof($tmp) < 1) {

	$remaining = str_replace($tmp[$j].",","",$remaining);
	$remaining = str_replace($tmp[$j],"",$remaining);
}
for($j=0;$j < sizeof($tmp) - 1;$j++) {

	$remaining = str_replace($tmp[$j].",","",$remaining);
	$remaining = str_replace($tmp[$j],"",$remaining);
}

$seen = $row["read"];
$tmp = explode(",",$row["accept"]);
if(sizeof($tmp) < 1) {

	$seen = str_replace($tmp[$j].",","",$seen);
	$seen = str_replace($tmp[$j],"",$seen);
}
for($j=0;$j < sizeof($tmp) - 1;$j++) {

	$seen = str_replace($tmp[$j].",","",$seen);
	$seen = str_replace($tmp[$j],"",$seen);
}

$tmp = explode(",",$row["rejet"]);
if(sizeof($tmp) < 1) {

	$seen = str_replace($tmp[$j].",","",$seen);
	$seen = str_replace($tmp[$j],"",$seen);
}
for($j=0;$j < sizeof($tmp) - 1;$j++) {

	$seen = str_replace($tmp[$j].",","",$seen);
	$seen = str_replace($tmp[$j],"",$seen);
}

$obj = new stdClass();
$obj->id = $row['id'];
$obj->message_id = $row['message_id'];
$obj->sender = $row["userid"];
$obj->rejet = $row["rejet"];
$obj->accept = $row["accept"];
$obj->seen = $seen;
$obj->remaining = $remaining;
$obj->userid = $row['userid'];
$obj->session_status = $session_check;
//header("content-type: text/javascript");
echo json_encode($obj);
?>