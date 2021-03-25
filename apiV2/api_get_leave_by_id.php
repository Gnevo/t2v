<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$employee = new employee();

$leave_details = $employee->get_leave_details_byID($_REQUEST['leave_id']);
$obj = new stdClass();
$obj->session_status= $session_check;
$obj->employee 		= $leave_details[0]['employee'];
$obj->empname 		= $leave_details[0]['empname'];
$obj->status 		= $leave_details[0]['status'];
$obj->appr_date 	= $leave_details[0]['appr_date'];
$obj->appr_empname 	= $leave_details[0]['appr_empname'];

echo json_encode($obj);
?>