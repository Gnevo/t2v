<?php
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/employee.php');
$employee = new employee();
$leave_details = $employee->get_leave_details_byID($_REQUEST['leave_id']);
$obj->employee = $leave_details[0]['employee'];
$obj->empname = $leave_details[0]['empname'];
$obj->status = $leave_details[0]['status'];
$obj->appr_date = $leave_details[0]['appr_date'];
$obj->appr_empname = $leave_details[0]['appr_empname'];
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>