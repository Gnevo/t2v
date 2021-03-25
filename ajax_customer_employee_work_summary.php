<?php

require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('class/user.php');
require_once ('class/company.php');
require_once ('plugins/message.class.php');
require_once('configs/config.inc.php');
$smarty = new smartySetup(array('gdschema.xml', 'month.xml', 'button.xml', 'messages.xml'),FALSE);
$customer = new customer();
$employee = new employee();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$year_week = $_REQUEST['year_week'];

$access_user = '';
if(isset($_REQUEST['customer']))
    $access_user = $_REQUEST['customer'];
else if(isset($_REQUEST['employee']))
    $access_user = $_REQUEST['employee'];

$customers_to_allocate = $customer->non_allocated_customers($year_week);
$employees_to_allocate = $access_user != '' ? $employee->employee_to_allocate($year_week, $access_user) : array();
$leave_employees = $employee->leave_employee_week($year_week);

if($customers_to_allocate) 
    $smarty->assign('customers_to_allocate', $customers_to_allocate);
if($employees_to_allocate) 
    $smarty->assign('employees_to_allocate', $employees_to_allocate);
if($leave_employees)
    $smarty->assign('leave_employees', $leave_employees);
$smarty->assign('year_week', $year_week);
$smarty->display('ajax_customer_employee_work_summary.tpl');
?>