<?php

require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('class/team.php');
require_once ('plugins/message.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml","messages.xml"), FALSE);
$employee = new employee();
$customer = new customer();
$team = new team();
$msg = new message();
//$year_week = $_GET['year_week'];
//$the_employee = $_GET['employee'];
$year_week = $_POST['year_week'];
$the_employee = $_POST['employee'];
$the_customer = $_POST['customer'];
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);// assign sortby firstname or lastname

$smarty->assign('message', $msg->show_message());

$customers_to_allocate = $customer->non_allocated_customers($year_week);
if($customers_to_allocate){
    $smarty->assign('customers_to_allocate', $customers_to_allocate);
}

if(isset($_POST['employee']))
    $employees_to_allocate = $employee->employee_to_allocate($year_week, $the_employee);
else if(isset($_POST['customer']))
    $employees_to_allocate = $employee->employee_to_allocate($year_week, $the_customer);
else if(isset($_POST['week']))
    $employees_to_allocate = $employee->employee_to_allocate($year_week, '');
if($employees_to_allocate){
    $smarty->assign('employees_to_allocate', $employees_to_allocate);
}

$leave_employees = $employee->leave_employee_week($year_week);
if($leave_employees){
    $smarty->assign('leave_employees', $leave_employees);
}

$smarty->assign('year_week', $year_week);
$smarty->display("ajax_worker_wrapper_section.tpl");
?>