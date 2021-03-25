<?php
require_once('class/setup.php');
//require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('class/company.php');
//require_once ('plugins/date_calc.class.php');
require_once ('plugins/message.class.php');
$smarty = new smartySetup(array('gdschema.xml', 'month.xml', 'button.xml', 'messages.xml'),FALSE);
//$date = new datecalc();
//$obj_cust = new customer();
$obj_emp = new employee();
$obj_company = new company();
$msg = new message();
$year = date('Y')+1;
$first_monday = date('d',strtotime("first Monday of January ".$year));
$last_day = 31;
if($first_monday > 6){
    $last_day = $last_day - $first_monday;
}
$slots_with_user = array();
$slots_without_user = array();
if($_REQUEST['customer'] != '' && $_REQUEST['employee'] != ''){
    $slots_without_user = $obj_emp->timetable_customer_employee_slots_copiable_with_options($_REQUEST['customer'], $_REQUEST['employee'], $_REQUEST['date'],0);
    $slots_with_user = $obj_emp->timetable_customer_employee_slots_copiable_with_options($_REQUEST['customer'], $_REQUEST['employee'], $_REQUEST['date'],1);
}else if($_REQUEST['customer'] !='' && $_REQUEST['employee'] == ''){
     $slots_without_user = $obj_emp->timetable_customer_employee_slots_copiable_with_options($_REQUEST['customer'], '', $_REQUEST['date'],0);
     $slots_with_user = $obj_emp->timetable_customer_employee_slots_copiable_with_options($_REQUEST['customer'], '', $_REQUEST['date'],1);
}    
else if($_REQUEST['customer'] =='' && $_REQUEST['employee'] != ''){
    $slots_without_user =  $obj_emp->timetable_customer_employee_slots_copiable_with_options('', $_REQUEST['employee'], $_REQUEST['date'],0);
    $slots_with_user = $obj_emp->timetable_customer_employee_slots_copiable_with_options('', $_REQUEST['employee'], $_REQUEST['date'],1);
    
}
$smarty->assign('slots_with_user','0');
$smarty->assign('slots_without_user','0');
if(count($slots_with_user))
    $smarty->assign('slots_with_user','1');

if(count($slots_without_user))
    $smarty->assign('slots_without_user','1');


$smarty->assign('cur_week',date('W',strtotime($_REQUEST['date'])));
$smarty->assign('cur_date',$_REQUEST['date']);
$smarty->assign('cur_year_of_week',date('o',strtotime($_REQUEST['date'])));

$smarty->assign('message', $msg->show_message()); //messages of actions
if(isset($_REQUEST['employee'])){
    $smarty->assign('employee',$_REQUEST['employee']);
}
if(isset($_REQUEST['customer'])){
    $smarty->assign('customer',$_REQUEST['customer']);
}

$smarty->assign('privilages',$obj_emp->get_privileges($_SESSION['user_id'], 1));
/* ------------------- getting company details - for getting contract hour flag---------------------- */
$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
/* ------------------- getting company details - for getting contract hour flag-----------endz----------- */

$smarty->assign('no_of_weeks',52);
$smarty->assign('emp_role', $_SESSION['user_role']); // role of employee logged in
$smarty->display('extends:layouts/ajax_popup.tpl|gdschema_process_copy.tpl');
?>
