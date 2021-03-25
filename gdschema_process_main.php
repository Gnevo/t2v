<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('class/user.php');
require_once ('class/company.php');
//require_once ('plugins/date_calc.class.php');
require_once ('plugins/message.class.php');
require_once('configs/config.inc.php');
$smarty = new smartySetup(array('gdschema.xml', 'month.xml', 'button.xml', 'messages.xml'),FALSE);
$obj_user = new user();
$obj_company = new company();
//$date = new datecalc();
$obj_cust = new customer();
$obj_emp = new employee();
$msg = new message();

global $week;
global $month;
$w_day_name = array();
$month_name = array();
foreach ($month as $m){
    $month_name[] = $smarty->translate[$m['label']];
}
foreach ($week as $w){
    $w_day_name[] = $smarty->translate[$w['label']];
}
$smarty->assign("week_day_names", $w_day_name);
  
$year = date('Y')+1;
$first_monday = date('d',strtotime("first Monday of January ".$year));
$last_day = 31;
if($first_monday > 6){
    $last_day = $last_day - $first_monday;
}

$smarty->assign('cur_week',substr($_REQUEST['cur_week'],5));
$smarty->assign('cur_year_week',$_REQUEST['cur_week']);
//$smarty->assign('no_of_weeks',date("W", mktime(0,0,0,12,$last_day,date('Y'))));
$smarty->assign('no_of_weeks',52);
$start_date = date('Y-m-d', strtotime(substr($_REQUEST['cur_week'],0,4)."W".str_pad(substr($_REQUEST['cur_week'],5),2,'0',STR_PAD_LEFT).'1'));
$start_date_minus = date('Y-m-d',strtotime($start_date .' -1 day'));
$end_date = date('Y-m-d', strtotime($start_date_minus.' +01 week'));
$emp_list = $obj_emp->employee_list_for_process($start_date, $end_date, $_REQUEST['user']);
if($emp_list){
    $smarty->assign('employee_details',$emp_list);
}
$smarty->assign('week_start_date', $start_date);
$smarty->assign('type',$_REQUEST['type']);
$smarty->assign('in_user', $_REQUEST['user']);
$in_user_role = $obj_user->user_role($_REQUEST['user']);
$smarty->assign('in_user_role', $in_user_role);
if($in_user_role == 4)
    $smarty->assign('in_user_details', $obj_cust->customer_detail ($_REQUEST['user']));
//forleave
$smarty->assign('leave_types', $smarty->leave_type);
$smarty->assign('emp_role', $_SESSION['user_role']); // role of employee logged in
//
$smarty->assign('privilages', $obj_emp->get_privileges($_SESSION['user_id'], 1));
/* ------------------- getting company details - for getting contract hour flag---------------------- */
$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
$months[0] = array("month_value" => date('Y-m', strtotime(substr($_REQUEST['cur_week'],0,4)."W".substr($_REQUEST['cur_week'],5)."7")),
                    "month_name" => date('Y', strtotime(substr($_REQUEST['cur_week'],0,4)."W".substr($_REQUEST['cur_week'],5)."7"))." ".
                                    $month_name[date('m', strtotime(substr($_REQUEST['cur_week'],0,4)."W".substr($_REQUEST['cur_week'],5)."7"))-1]
                  );
$months[1] = array("month_value" => date('Y-m', strtotime(substr($_REQUEST['cur_week'],0,4)."W".substr($_REQUEST['cur_week'],5)."1")),
                    "month_name" => date('Y', strtotime(substr($_REQUEST['cur_week'],0,4)."W".substr($_REQUEST['cur_week'],5)."1"))." ".
                                    $month_name[date('m', strtotime(substr($_REQUEST['cur_week'],0,4)."W".substr($_REQUEST['cur_week'],5)."1"))-1]
                  );
if($months[0]['month_value'] == $months[1]['month_value']){
    unset($months[1]);
}
$smarty->assign('months', $months);
/* ------------------- getting company details - for getting contract hour flag-----------endz----------- */
//setting layout and page
$smarty->assign('message', $msg->show_message()); //messages of actions
$smarty->display('extends:layouts/ajax_popup.tpl|gdschema_process_main.tpl');
?>