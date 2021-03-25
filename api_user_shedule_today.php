<?php
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/employee.php');
$employee = new employee();

$i = 0;
$data = $employee->employee_slots_day($_REQUEST['employee'],$_REQUEST['date']);
foreach($data as $slot) {

	$obj[$i] = $slot;
	$i++;
}
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>