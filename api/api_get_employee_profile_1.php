<?php
session_start();
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/employee.php');
//require_once('class/user.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$employee = new employee();
//$user = new user();

$data = $employee->get_employee_detail($_REQUEST['user']);
$obj = array();
$obj['employee'] = $data;
$obj['customers'] = $employee->customers_list_for_right_click($_REQUEST['user']);
	
//    echo "<pre>". print_r($obj, 1)."</pre>";
//header("content-type: text/javascript");
echo json_encode($obj);
?>