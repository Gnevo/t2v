<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('class/setup.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
$employee = new employee();

$i = 0;
$obj = array();
$data = $employee->employee_slots_day($_REQUEST['employee'],$_REQUEST['date']);
foreach($data as $slot) {
	$obj[$i] = $slot;
	$i++;
}
//header("content-type: text/javascript");
echo json_encode($obj);
?>