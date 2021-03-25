<?php
/*
 * Author: Shaju
 * Date: 2014-02-19
 * Purpose: to get the accessible employees of a user for report signing
 * 
 */
session_start();
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/report_signing.php');
require_once('class/leave.php');

$smarty = new smartySetup(array("user.xml"), FALSE);
$user = new user();
$employee = new employee();
$obj_rpt_signing = new report_signing();
$obj_leave = new leave();

$i = 0;
$data = $employee->employees_list_for_right_click($_REQUEST['user'], -1, $_REQUEST['user']);
$month = $_REQUEST['month'];
$year = $_REQUEST['year'];
$signed_employees = array();

//echo "<pre>".print_r($data, 1)."</pre>";
$employees = "'";
foreach($data as $employee) {
    if($i != 0)
        $employees .= "','"; 
    $employees .=  $employee['username'];
    $i++;
}
$employees .= "'";

$i = 0;
$data = $obj_rpt_signing->get_employees_having_schedule($month, $year, $employees);
$employees = "'";
foreach($data as $employee) {
    if($i != 0)
        $employees .= "','"; 
    $employees .=  $employee['employee'];
    $signed_employees[$employee['employee']] = $employee;
    $i++;
}
$employees .= "'";

$not_signed_employees = $obj_rpt_signing->get_unsigned_employees($year, $month, $employees);


$i = 0;
$temp = array();
$obj = array();
foreach($not_signed_employees as $employee) {
        if(!in_array($employee['employee'], $temp)){
            $temp[] = $employee['employee'];
            $obj['unsigned'][$i]->employee = $employee['employee'];
            $obj['unsigned'][$i]->first_name = $signed_employees[$employee['employee']]['first_name'];
            $obj['unsigned'][$i]->last_name = $signed_employees[$employee['employee']]['last_name'];
            $obj['unsigned'][$i]->mobile = $signed_employees[$employee['employee']]['mobile'];
            if(in_array($employee['employee'], array_keys($signed_employees))){
                unset($signed_employees[$employee['employee']]);
            }
            $i++;
        }
	
}
$obj['unsigned_count'] = count($temp);

$untreated_leave_employees = $obj_leave->get_untreated_leave_employees($year, $month, $employees);
//echo "<pre>".print_r($untreated_leave_employees, 1)."</pre>";
$obj['untreated_count'] = count($untreated_leave_employees);
$i = 0;
foreach($untreated_leave_employees as $employee) {

	$obj['untreated'][$i]->employee = $employee['employee'];
	$obj['untreated'][$i]->first_name = $employee['first_name'];
	$obj['untreated'][$i]->last_name = $employee['last_name'];
        $obj['untreated'][$i]->mobile = $employee['mobile'];
	$i++;
}
//echo "<pre>".print_r($obj['untreated'], 1)."</pre>";
$obj['signed_count'] = count($signed_employees);
$i = 0;
foreach($signed_employees as $employee) {

	$obj['signed'][$i]->employee = $employee['employee'];
	$obj['signed'][$i]->first_name = $employee['first_name'];
	$obj['signed'][$i]->last_name = $employee['last_name'];
        $obj['signed'][$i]->mobile = $signed_employees[$employee['employee']]['mobile'];
	$i++;
}
//echo "<pre>".print_r($obj, 1)."</pre>";

//header("content-type: text/javascript");
echo json_encode($obj);
?>