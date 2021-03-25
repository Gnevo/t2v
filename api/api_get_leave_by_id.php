<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$employee = new employee();

$leave_details = $employee->get_leave_details_byID($_REQUEST['leave_id']);
$obj = new stdClass();
$obj->employee = $leave_details[0]['employee'];
$obj->empname = $leave_details[0]['empname'];
$obj->status = $leave_details[0]['status'];
$obj->appr_date = $leave_details[0]['appr_date'];
$obj->appr_empname = $leave_details[0]['appr_empname'];
//header("content-type: text/javascript");
echo json_encode($obj);
?>