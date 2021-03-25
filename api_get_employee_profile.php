<?php
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/user.php');
require_once('class/employee.php');
$user = new user();
$employee = new employee();

$data = $employee->get_employee_detail($_REQUEST['user']);
$obj['employee'] = $data;
$obj['customers'] = $employee->customers_list_for_right_click($_REQUEST['user']);
	
//    echo "<pre>". print_r($obj, 1)."</pre>";
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>