<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/leave.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();

$count = 0;
$data = $leave->get_alloc_user_messages();
foreach($data as $row) {
	if($row['employee'] == "")
		$count++;
}

$obj = new stdClass();
$obj->count = $count;
$obj->session_status = $session_check;

echo json_encode($obj);
?>