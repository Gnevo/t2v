<?php
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/employee.php');
$employee = new employee();

require_once('class/customer.php');
$customer = new customer();

$data = $customer->customer_detail($_REQUEST['user']);
$obj['customer'] = $data;
$obj['employees'] = $employee->employees_list_for_right_click($_REQUEST['user']);
	
//    echo "<pre>". print_r($obj, 1)."</pre>";
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>