<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$employee = new employee();

$obj = new stdClass();
$data = $employee->get_available_users($_REQUEST['customer'],$_REQUEST['time_from'],$_REQUEST['time_to'],$_REQUEST['date']);
$obj->count = sizeof($data);
$obj->session_status = $session_check;
echo json_encode($obj);
?>