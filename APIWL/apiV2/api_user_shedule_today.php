<?php
require_once('api_common_functions.php');
$session_check = check_user_session();

require_once('class/setup.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$employee = new employee();

$i = 0;
$obj = array();
$data = $employee->employee_slots_day($_REQUEST['employee'],$_REQUEST['date']);
foreach($data as $slot) {
	$obj[$i] = $slot;
	$i++;
}
$main_obj = new stdClass();
$main_obj->session_status = $session_check;
$main_obj->data_set = $obj;
echo json_encode($main_obj);
?>