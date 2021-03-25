<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/leave.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$leave = new leave();

$data = $leave->get_all_leave_request_admin();
$obj = new stdClass();
$obj->session_status = $session_check;
$obj->count = sizeof($data);
echo json_encode($obj);
?>