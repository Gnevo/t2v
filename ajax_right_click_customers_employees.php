<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/customer.php');
//require_once('class/team.php');
$smarty = new smartySetup(array("user.xml", "messages.xml", "button.xml","privilege.xml","month.xml","gdschema.xml"), FALSE);
$employee = new employee();
//$team = new team();
$customer = new customer();

$page_user = '';
// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
if(isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '') 
    $page_user = trim($_REQUEST['employee']);
else if(isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '') 
    $page_user = trim($_REQUEST['customer']);

$smarty->assign('page_user', $page_user);
$smarty->assign('week_year',$_REQUEST['week_num']);

$action = '';
if($_REQUEST['action'] == 'goto_employee'){
    $righclick_employees = $employee->employees_list_for_right_click($page_user);
    $smarty->assign('righclick_employees', $righclick_employees);
    $action = 'goto_employee';
}
else if($_REQUEST['action'] == 'goto_customer'){
    //$righclick_customers = $employee->customers_list_for_right_click($page_user);
    $righclick_customers = $customer->customer_list();
    $smarty->assign('righclick_customers', $righclick_customers);
    $action = 'goto_customer';
}
else if($_REQUEST['action'] == 'goto_week'){
    $years_work = $employee->distinct_years();
    $smarty->assign("year_option_values", $years_work);
    $week_num_assign = explode('|', $_REQUEST['week_num']);
    $smarty->assign('report_year',$week_num_assign[0]);
    $smarty->assign('report_week',$week_num_assign[1]);
    
    $week_year = explode("|", $_REQUEST['week_num']);
    $year = $week_year[0];
    $start_week = date('W', strtotime($year."-01-01"));
    $end_week = date('W', strtotime($year."-12-31"));
    if ($end_week == '01') {   
        $end_week = date('W', strtotime($year . '-12-24'));
        $smarty->assign('less_1',1);
    }
    $smarty->assign('start',  intval($start_week));
    $smarty->assign('end_week',intval($end_week));
    $smarty->assign('year',$year);
    $action = 'goto_week';
}
$smarty->assign('action', $action);
$smarty->display("ajax_right_click_customers_employees.tpl");
?>