<?php
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/employee.php');
$employee = new employee();

$data = $employee->get_available_users($_REQUEST['customer'],$_REQUEST['time_from'],$_REQUEST['time_to'],$_REQUEST['date']);
$obj->count = sizeof($data);
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>