<?php
session_start();
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$employee = new employee();

$obj = new stdClass();
$data = $employee->get_available_users($_REQUEST['customer'],$_REQUEST['time_from'],$_REQUEST['time_to'],$_REQUEST['date']);
$obj->count = sizeof($data);
//header("content-type: text/javascript");
echo json_encode($obj);
?>