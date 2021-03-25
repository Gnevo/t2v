<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
session_name('t2v-cirrus');
session_start('t2v-cirrus');
//echo $_SESSION['user_id'];
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
$smarty = new smartySetup(array("user.xml"), FALSE);
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
$obj = array();
foreach($data as $employee) {

	$user->username = $employee;
	$tmp = $user->get_employee_detail();
        $obj[$i] = new stdClass();
	$obj[$i]->employee = $employee;
	$obj[$i]->first_name = $tmp['first_name'];
	$obj[$i]->last_name = $tmp['last_name'];
        //$obj[$i]->mobile = $tmp['mobile'];
        //$obj[$i]->email = $tmp['email'];
	$i++;
}
//header("content-type: text/javascript");
echo json_encode($obj);
?>