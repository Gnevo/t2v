<?php
/*
 * Author: Shaju
 * Date: 2014-02-19
 * Purpose: to get the accessible employees of a user for report signing
 * 
 */
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once('class/setup.php');
require_once('class/user.php');
require_once('class/employee.php');
require_once('class/customer.php');
require_once('class/report_signing.php');
require_once('class/leave.php');

$smarty = new smartySetup(array("user.xml"), FALSE);
$user = new user();
$employee = new employee();
$obj_rpt_signing = new report_signing();
$obj_leave = new leave();
$obj_customer = new customer();

$i = 0;
$data = $employee->employees_list_for_right_click($_REQUEST['user'], -1, $_REQUEST['user']);
$search_customers = $obj_customer->customers_list_for_employee_report();
$month = $_REQUEST['month'];
$year = $_REQUEST['year'];
$signed_employees = array();

$employees_temp_array = array();
if(!empty($data)){
    foreach($data as $employee) {
        $employees_temp_array[] = $employee['username'];
    }
}
$employees = "'" . implode("','", $employees_temp_array) . "'";

$search_cust_ids = array();
if(!empty($search_customers)){
    foreach($search_customers as $this_customer)
        $search_cust_ids[] = $this_customer['username'];
}
$access_customers_string = "'" . implode("','", $search_cust_ids) . "'";

$i = 0;
$data = $obj_rpt_signing->get_employees_having_schedule($month, $year, $employees, $access_customers_string);
$employees_temp_array = array();
if(!empty($data)){
    foreach($data as $employee) {
        $employees_temp_array[] = $employee['employee'];
        $signed_employees[$employee['employee']] = $employee;
    }
}
$employees = "'" . implode("','", $employees_temp_array) . "'";

$customers_temp_array = array();
if(!empty($data)){
    foreach($data as $employee) {
        $customers_temp_array[] = $employee['customer'];
    }
}
$customer_string_who_have_slots = "'" . implode("','", array_unique($customers_temp_array)) . "'";

$not_signed_employees = $obj_rpt_signing->get_unsigned_employees($year, $month, $employees, $customer_string_who_have_slots);
//echo "<pre>".print_r($not_signed_employees, 1)."</pre>";

$i = 0;
$temp = array();
$obj = array();
foreach($not_signed_employees as $employee) {
    if(!in_array($employee['employee'], $temp)){
        $temp[] = $employee['employee'];
        $obj['unsigned'][$i] = new stdClass();
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
    $obj['untreated'][$i] = new stdClass();
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
    $obj['signed'][$i] = new stdClass();
	$obj['signed'][$i]->employee = $employee['employee'];
	$obj['signed'][$i]->first_name = $employee['first_name'];
	$obj['signed'][$i]->last_name = $employee['last_name'];
    $obj['signed'][$i]->mobile = $signed_employees[$employee['employee']]['mobile'];
	$i++;
}
// echo "<pre>".print_r($obj, 1)."</pre>";

//header("content-type: text/javascript");
echo json_encode($obj);
?>