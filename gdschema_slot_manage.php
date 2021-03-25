<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('class/company.php');
require_once ('plugins/message.class.php');
//require_once ('plugins/date_calc.class.php');
$smarty = new smartySetup(array('gdschema.xml', 'month.xml', 'button.xml', 'messages.xml', 'reports.xml', 'mail.xml'),FALSE);
//$date = new datecalc();
$customer = new customer();
$employee = new employee();
$obj_company = new company();
$msg = new message();
$smarty->assign('leave_types', $smarty->leave_type);
$smarty->assign('emp_alloc', $_SESSION['user_id']);
$smarty->assign('emp_role', $_SESSION['user_role']); // role of employee logged in

$smarty->assign('copy_flag',0);
$slot = $_REQUEST['slot'];
//assign slot type
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
if($slot == $_SESSION['swap']){
    $smarty->assign('swap_button_hide',"1");
}
//updating slot type
if ($_REQUEST['action'] == 'type') {
    $type = $_REQUEST['type'];
}

$slot_details = $customer->customer_employee_slot_details($slot);
$slot_det = $employee->customer_employee_slot_details($slot);
$dat = $employee->get_privileges($_SESSION['user_id'], 1, $slot_details['customer']);
$smarty->assign('privileges_gd', $dat);
$smarty->assign('privilages',$dat);
$smarty->assign('coming',$_REQUEST['coming']);
$available_employees = $employee->get_available_users($slot_det['customer'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['date']);
$smarty->assign('available_employees',$available_employees);

$available_customers = $customer->get_available_customers($slot_det['employee'], $slot_det['date']);
$smarty->assign('available_customers',$available_customers);

$smarty->assign('day_name',  strtolower(date("l", strtotime($slot_details['date']))));
$smarty->assign('inconv_timings', $employee->get_inconvenient_on_a_day($slot_details['date'],3));


$slots = explode('-', $slot_details['slot']);
$smarty->assign('time_from', $slots[0]);
$smarty->assign('time_to', $slots[1]);
$smarty->assign('slot_details', $slot_details);
$smarty->assign('cur_slot_year_of_week',date('o',strtotime($slot_details['date'])));
//echo "<pre>".print_r($slot_details, 1)."</pre>";
$smarty->assign('message',$msg->show_message());
$smarty->assign('cur_week',date('W',  strtotime($slot_details['date'])));
$smarty->assign('in_user',$_SESSION['user_id']);
$smarty->assign('no_of_weeks',52);
/*if($_SESSION['user_role'] == 1){
    $smarty->assign('process_previlege', 1);
    $smarty->assign('swap_previlege', 1);
}    
else{
    $smarty->assign('process_previlege', $employee->has_privilege($_SESSION['user_id'], 'process'));
    $smarty->assign('swap_previlege', $employee->has_privilege($_SESSION['user_id'], 'swap'));
}    
setting layout and page
echo "<pre>".print_r(array($slot_details['customer'], $slots[0], $slots[1], $slot_details['date']), 1)."</pre>";*/
if($_SESSION['user_role'] != 3){
    $avail_replace_employees = $employee->get_available_users($slot_details['customer'], $slots[0], $slots[1], $slot_details['date']);
    $smarty->assign('avail_replace_employees', $avail_replace_employees);

    //$avail_replace_employees_date = $employee->get_available_users($slot_details['customer'], 0, 24, $slot_details['date']);
    $avail_replace_employees_date = $employee->get_available_users_btwn_a_date_range($slot_details['employee'], $slot_details['date'], $slot_details['date']);
    $smarty->assign('avail_replace_employees_date', $avail_replace_employees_date);
}
$tl_flag = FALSE;
if($slot_details['employee'] != '' && $slot_details['customer'] != ''){
       
    if($employee->check_login_employee_to_access_employee($slot_details['employee']) && $customer->check_login_employee_to_access_customer($slot_details['customer']))
        $tl_flag = TRUE;
    
}elseif($slot_details['employee'] != ''){
    $tl_flag = $employee->check_login_employee_to_access_employee($slot_details['employee']);
}elseif($slot_details['customer'] != ''){
    $tl_flag = $customer->check_login_employee_to_access_customer($slot_details['customer']);
}

$smarty->assign('tl_flag', $tl_flag);
/* ------------------- getting company details - for getting contract hour flag---------------------- */
$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
/* ------------------- getting company details - for getting contract hour flag-----------endz----------- */

$smarty->assign('swap_var', $_SESSION['swap']);
$smarty->display('gdschema_slot_manage.tpl');
?>