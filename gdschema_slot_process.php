<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('class/company.php');
require_once ('class/user.php');
//require_once ('plugins/date_calc.class.php');
$obj_user = new user();
$smarty = new smartySetup(array('gdschema.xml', 'month.xml', 'button.xml', 'messages.xml'),FALSE);
$obj_cust = new customer();
$obj_emp = new employee();
$obj_company = new company();
//$date = new datecalc();

$smarty->assign('cur_date', $_REQUEST['date']);
$smarty->assign('alloc_week_days', $week_days);
$smarty->assign('emp_alloc', $_SESSION['user_id']);
$smarty->assign('emp_role', $_SESSION['user_role']); // role of employee logged in
$smarty->assign('flag_skill_remove', false);
$smarty->assign('privileges_gd', $obj_emp->get_privileges($_SESSION['user_id'], 1));
$slots = array();

$flag_sign = 0;
if ((isset($_REQUEST['employee']) || $_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 5) && (isset($_REQUEST['customer']) || $_SESSION['user_role'] == 4)) {
    $cust = '';
    $emp = $_SESSION['user_id'];
    if($_SESSION['user_role'] == 3 || $_SESSION['user_role'] == 5)
        $emp = $_SESSION['user_id'];
    if(isset($_REQUEST['employee']))
        $emp = $_REQUEST['employee'];
    if($_SESSION['user_role'] == 4)
        $cust = $_SESSION['user_id'];
    if(isset($_REQUEST['customer']))
        $cust = $_REQUEST['customer'];
    $flag_sign = $obj_emp->chk_employee_rpt_signed($emp, $cust, $_REQUEST['date']);
    $slots = $obj_emp->timetable_customer_employee_slots_copiable($cust, $emp, $_REQUEST['date']);
} else if (isset($_REQUEST['employee']) && !isset($_REQUEST['customer'])) {
    $slots = $obj_emp->timetable_customer_employee_slots_copiable('', $_REQUEST['employee'], $_REQUEST['date']);
} else if (!isset($_REQUEST['employee']) && isset($_REQUEST['customer'])) {
    $slots = $obj_emp->timetable_customer_employee_slots_copiable($_REQUEST['customer'], '', $_REQUEST['date']);
}
$smarty->assign('flag_sign', $flag_sign);
$smarty->assign('flag_copy', 0);
if(count($slots))
    $smarty->assign('flag_copy', 1);

$smarty->assign('flag_paste',0);
if($obj_user->retrieve_from_temp_session(1) != '' && $flag_sign == 0){
    $smarty->assign('flag_paste',1);
}

//echo $_REQUEST['date'];
if (isset($_REQUEST['employee'])) {
    $cur_employee['userid'] = $_REQUEST['employee'];
    $emp = $obj_emp->employee_data($_REQUEST['employee']);
    $cur_employee['name'] = $emp['first_name'] . ' ' . $emp['last_name'];
    $cur_employee['code'] = $emp['code'];
    $cur_employee['contract_week_hour'] = $obj_emp->employee_contract_week_hour($cur_employee['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date));
    $cur_employee['week_worked_hour'] = $obj_emp->employee_timetable_week_time($cur_employee['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date));
    $smarty->assign('employee', $cur_employee);
}
if (isset($_REQUEST['customer'])) {
    $cur_customer['userid'] = $_REQUEST['customer'];
    $cust = $obj_cust->customer_data($_REQUEST['customer']);
    $cur_customer['name'] = $cust['first_name'] . ' ' . $cust['last_name'];
    $cur_customer['code'] = $cust['code'];
    $cur_customer['contract_week_hour'] = $obj_cust->customer_contract_week_hour($cur_customer['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date));
    $cur_customer['week_worked_hour'] = $obj_cust->customer_timetable_week_time($cur_customer['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date));
    $smarty->assign('customer', $cur_customer);
}

//if($_SESSION['user_role'] == 1){
//    $smarty->assign('process_previlege', 1);
//    $smarty->assign('swap_previlege', 1);
//}    
//else{
//    $smarty->assign('process_previlege', $obj_emp->has_privilege($_SESSION['user_id'], 'process'));
//    $smarty->assign('swap_previlege', $obj_emp->has_privilege($_SESSION['user_id'], 'swap'));
//}

//$slot_details = array()

//print_r($_SESSION['copy_slot']);
$smarty->assign('privilages', $obj_emp->get_privileges($_SESSION['user_id'], 1));
/* ------------------- getting company details - for getting contract hour flag---------------------- */
$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
/* ------------------- getting company details - for getting contract hour flag-----------endz----------- */

//setting layout and page
$smarty->display('extends:layouts/ajax_popup.tpl|gdschema_slot_process.tpl');

?>