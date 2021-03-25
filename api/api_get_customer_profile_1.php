<?php
session_start();
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$employee = new employee();
$customer = new customer();

$data = $customer->customer_detail($_REQUEST['user']);
$obj = array();
$obj['customer'] = $data;
$obj['employees'] = $employee->employees_list_for_right_click($_REQUEST['user']);
	
//    echo "<pre>". print_r($obj, 1)."</pre>";
//header("content-type: text/javascript");
echo json_encode($obj);
?>