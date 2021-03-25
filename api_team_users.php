<?php
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
require_once('class/user.php');
require_once('class/employee.php');
$user = new user();
$employee = new employee();

$i = 0;
//echo "<pre>".print_r($_REQUEST, 1)."</pre>";
//echo urldecode($_REQUEST['search_cont']);
//echo '<br/>';
if(isset($_REQUEST['search_cont'])){
    $data = $employee->employee_list_exact($_REQUEST['user'], $_REQUEST['search_cont']);
}else{
    $data = $employee->employee_list_exact($_REQUEST['user']);
}
foreach($data as $employee) {

	$user->username = $employee;
	$tmp = $user->get_employee_detail();
	$obj[$i]->employee = $employee;
	$obj[$i]->first_name = $tmp['first_name'];
	$obj[$i]->last_name = $tmp['last_name'];
        //$obj[$i]->mobile = $tmp['mobile'];
        //$obj[$i]->email = $tmp['email'];
	$i++;
}
header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>