<?php
session_start();
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('class/setup.php');
require_once('class/leave.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();

$i = 0;
$obj = array();
$data = $leave->get_all_leave_request_admin();
foreach($data as $rows) {

	$obj[$i]->mreq_id = $rows['mreq_id'];
	$obj[$i]->message_id = $rows['message_id'];
	$obj[$i]->message_user = $rows['userid'];
	$obj[$i]->status = $rows['status'];
	$rows = $leave->get_leave_request_details_by_id($rows['message_id'],1);
	$obj[$i]->userid = $rows['userid'];
	$obj[$i]->reciever_ids = $rows['reciever_ids'];
	$obj[$i]->accept = $rows['accept'];
	$obj[$i]->rejet = $rows['rejet'];
	$obj[$i]->read = $rows['read'];
	$obj[$i]->apt_time = $rows['apt_time'];
	$obj[$i]->rej_time = $rows['rej_time'];
	$obj[$i]->read_time = $rows['read_time'];
	$rows = $leave->get_slot_by_id($rows['message_id']);
	$rows = $leave->get_slot_by_id($rows['relation_id']);
	$obj[$i]->employee = $rows['employee'];
	$obj[$i]->leave_date = $rows['date'];
	$obj[$i]->time_from = $rows['time_from'];
	$obj[$i]->time_to = $rows['time_to'];
	$i++;
}
//header("content-type: text/javascript");
echo json_encode($obj);
?>