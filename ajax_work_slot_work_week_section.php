<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('class/team.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml","messages.xml"), FALSE);
$employee = new employee();
$customer = new customer();
$team = new team();
$year_week = $_POST['year_week'];
$the_employee = $_POST['employee'];
$the_customer = $_POST['customer'];
$employee_name = $_POST['employee_name'];
$customer_username = $_POST['customer_username'];
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);// assign sortby firstname or lastname
$smarty->assign('emp_role', $_SESSION['user_role']);
$smarty->assign('emp_id', $_SESSION['user_id']);
$smarty->assign('customer', $_POST['customer_username']);
//gdschema week data

$smarty->assign('privileges', $employee->employee_privilege());
if(isset($_POST['employee_name'])){
//    $year_week = urldecode($_POST['year_week']);
    
    $employee_username = $team->get_employee_username($employee_name);
     $employee_data = $employee->employee_data($employee_username);
     $smarty->assign('employee_data', $employee_data);
}
else if(isset($_POST['employee'])){
    $employee_data = $employee->employee_data($the_employee);
    $smarty->assign('employee_data', $employee_data);
}else if(isset($_POST['customer'])){
    $customer_data = $customer->customer_data($the_customer);
    $smarty->assign('customer_data', $customer_data);
}

$smarty->assign('privileges_gd', $employee->get_privileges($_SESSION['user_id'], 1));//setting previlege
if(isset($_POST['employee_name'])){
//    $year_week = urldecode($_POST['year_week']);
    
    $employee_username = $team->get_employee_username($employee_name);
     $smarty->assign('employee_week', $employee->employee_slots_week_for_customer($employee_username, $year_week,$customer_username));
}
else if(isset($_POST['employee']))
    $smarty->assign('employee_week', $employee->employee_slots_week($the_employee, $year_week));
else if(isset($_POST['customer']))
    $smarty->assign('customer_week', $customer->customer_slots_week($the_customer, $year_week));

if(isset($_POST['employee_name'])){
    $smarty->assign('user_type', 'employee_customer');
}
else if(isset($_POST['employee']))
    $smarty->assign('user_type', 'employee');
else if(isset($_POST['customer']))
    $smarty->assign('user_type', 'customer');

$smarty->assign('year_week', $year_week);
$smarty->display("ajax_work_slot_work_week_section.tpl");
?>