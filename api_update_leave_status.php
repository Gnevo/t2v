<?php
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/employee.php');
$employee = new employee();

$employee->leave_id = $_REQUEST['leave_id'];
$employee->leave_status = $_REQUEST['status'];
if($employee->update_leave_status())
	$obj->success = "0";
else
	$obj->success = "1";
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>