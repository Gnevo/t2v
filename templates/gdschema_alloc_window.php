<?php

/*
 * Done by  Shaju
 * Modified by Shamsu
 * Adding New time slot
 * For allocation of work, users to a particular time slot
 * display variables for gdschema_alloc.tpl
 */

require_once ('class/setup.php');
require_once ('class/customer.php');
require_once ('class/employee.php');
require_once ('class/team.php');
require_once ('class/company.php');
require_once ('class/user.php');
require_once ('plugins/date_calc.class.php');
require_once ('plugins/message.class.php');
require_once ('class/contract.php');
require_once ('class/general.php');
require_once('class/timetable.php');
//require_once ('class/dona.php');
$smarty         = new smartySetup(array("gdschema.xml", "month.xml","messages.xml",'user.xml', 'button.xml', 'tooltip.xml', 'contract.xml', 'reports.xml', 'mail.xml'),FALSE);
$week_date = new datecalc();
$customer = new customer();
$employee = new employee();
$obj_company = new company();
$team = new team();
$msg = new message();
$obj_contract = new contract();
$obj_user = new user();
//$dona = new dona();

$cur_employee = array();
$cur_customer = array();
$slot_detail = array();
$cur_date = strtotime($_REQUEST['date'] . ' 00:00:00');
$cur_date_oW = date('o|W', $cur_date);
$cur_date_YW = date('Y|W', $cur_date);
$cur_date_Y = date('Y', $cur_date);
$cur_date_W = date('W', $cur_date);
$cur_date_m = date('m', $cur_date);
$cur_date_Ym = date('Y|m', $cur_date);
$smarty->assign('sort_by_name', isset($_SESSION['company_sort_by']) ? $_SESSION['company_sort_by'] : '');
//$cur_date_W = date('W', $cur_date);
$week_days = $week_date->get_week_days($cur_date_oW, $_REQUEST['date']);

/*$signed_date = $employee->get_signed_date($_REQUEST['employee']);
for($i=0; $i<7;$i++){
    if(strtotime($signed_date) < strtotime($week_days[$i]['date']))
        $week_days[$i]['flag'] = 1;
    else
        $week_days[$i]['flag'] = 0;
}*/
$holidays = $employee->get_holiday_details($cur_date_m, $cur_date_Y, true);
$holidays_week = $employee->get_holiday_details_by_date($week_days[0]['date'], $week_days[6]['date'], true);
/* ------------------------------- process for navigation system---------------------- */
//$prev_week_day = date('Y-m-d', strtotime($_REQUEST['date']. " -7 day"));
//$prev_week_day = date('Y-m-d', strtotime('last monday', strtotime($_REQUEST['date'])));
$prev_week_day = date('Y-m-d', strtotime('monday last week', strtotime($_REQUEST['date'])));
//$next_week_day = date('Y-m-d', strtotime($_REQUEST['date']. " +7 day"));
$next_week_day = date('Y-m-d', strtotime('next monday', strtotime($_REQUEST['date'])));
$smarty->assign('alloc_prev_week_day', $prev_week_day);
$smarty->assign('alloc_next_week_day', $next_week_day);
/*if(isset($_REQUEST['customer']) && isset($_REQUEST['employee']))
    $back_url = 'week/gdschema/'.$cur_date_oW.'/1/8/';
else */if(isset($_REQUEST['customer']))
    $back_url = 'customer/gdschema/'.$cur_date_oW.'/'.$_REQUEST['customer'].'/';
else if(isset($_REQUEST['employee']))
//    $back_url = 'employee/gdschema/'.$cur_date_oW.'/'.$_REQUEST['employee'].'/';
    $back_url = 'all/gdschema/'.$cur_date_oW.'/';
$smarty->assign('back_url', $back_url);

if(isset($_REQUEST['return_page'])){
    if($_REQUEST['return_page'] == 'cust_report'){
//        $date = explode('-', $_REQUEST['date']);
        $back_button_url = 'report/month/week/customer/'.$_REQUEST['customer'].'/'.$_REQUEST['rep_start_date'].','.$_REQUEST['rep_end_date'].'/';
    }
    else if($_REQUEST['return_page'] == 'emp_report'){
        $date = explode('-', $_REQUEST['date']);
        $back_button_url = 'report/month/week/employee/'.$_REQUEST['employee'].'/'.$_REQUEST['rep_start_date'].','.$_REQUEST['rep_end_date'].'/';
    }
    else if($_REQUEST['return_page'] == 'emp_work_report'){
        $date = explode('-', $_REQUEST['date']);
        $back_button_url = 'report/work/employee/detail/'.$date[0].'/'.$date[1].'/'.$_REQUEST['employee'].'/'.$_REQUEST['customer'].'/';
    }
    else if($_REQUEST['return_page'] == 'mc_leave'){
        $date = explode('-', $_REQUEST['date']);
        $back_button_url = "message/center/leave/".substr($date,0,4)."/".substr($date,5,2)."/NULL/NULL/";
    }
    else if($_REQUEST['return_page'] == 'export'){
        $date = explode('-', $_REQUEST['date']);
        $back_button_url = "export_lon/";
    }
    else if($_REQUEST['return_page'] == 'comengo'){
        $date = explode('-', $_REQUEST['date']);
        $back_button_url = "comengo/";
    }
    if(!isset($_SESSION['report_return_url']) || $_SESSION['report_return_url'] == ''){
        $_SESSION['from_page'] = $_REQUEST['return_page'];
        $_SESSION['report_return_url'] = $smarty->url.$back_button_url;
    }
}
$smarty->assign('from_page', isset($_SESSION['from_page']) ? $_SESSION['from_page'] : '');
$smarty->assign('back_button_url', isset($_SESSION['report_return_url']) ? $_SESSION['report_return_url'] : '');
/* ------------------------------- process for navigation system endz---------------------- */

$smarty->assign('year_week', $cur_date_YW);       //current running week
$smarty->assign('cur_week', date('W', $cur_date));          //current running week
$smarty->assign('cur_date', $_REQUEST['date']);             //clicked date
$smarty->assign('selected_year', date("Y",  strtotime($_REQUEST['date'])));             
$smarty->assign('selected_month', date("m",  strtotime($_REQUEST['date'])));            //clicked date
$smarty->assign('holidays', $holidays);
$smarty->assign('holidays_week', $holidays_week);

$smarty->assign('alloc_week_days', $week_days);
$smarty->assign('emp_alloc', $_SESSION['user_id']);         //emplyee logged in
$smarty->assign('emp_role', $_SESSION['user_role']);        // role of employee logged in
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('login_user_role', $_SESSION['user_role']);

if(isset($_REQUEST['gritter_msg']) && $_REQUEST['gritter_msg'])
    $smarty->assign('message', $msg->show_message_data_for_gritter());
else
    $smarty->assign('message', $msg->show_message());           //messages of actions
$smarty->assign('privileges_gd', $employee->get_privileges($_SESSION['user_id'], 1, $_REQUEST['customer']));           //setting gdschema previlege
$smarty->assign('privileges_mc', $employee->get_privileges($_SESSION['user_id'], 3));           //setting message center previlege
$smarty->assign('inconv_timings', $employee->get_inconvenient_on_a_day($_REQUEST['date'],3));
$smarty->assign('inconv_timings_next', $employee->get_inconvenient_on_a_day(date('Y-m-d', strtotime(date('Y-m-d', $cur_date) . ' +1 day')),3));

/*if($_COOKIE['debug']){
    echo "<pre>".print_r(array($_SESSION['user_id'], 1, $_REQUEST['customer']), 1)."</pre>";
    echo "<pre>".print_r($employee->get_privileges($_SESSION['user_id'], 1, $_REQUEST['customer']), 1)."</pre>";
}*/
//additional datas for monthly view from day view-----------------------
$smarty->assign('leave_types', $smarty->leave_type);
$smarty->assign('no_of_weeks',52);
//additional datas for monthly view from day view------endz-----------------
//
//echo "<pre>".print_r($employee->get_privileges($_SESSION['user_id'], 1, $_REQUEST['customer']), 1)."</pre>";
//to know dont' show again
$__slot_employee = isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
$__slot_customer = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
$general_setting_cust_employee = $employee->get_customer_employee_general_setting($__slot_customer, $__slot_employee, 'dont_show_slot_operation_flag');
$dont_show_popup_flag = !empty($general_setting_cust_employee) && $general_setting_cust_employee[0]['dont_show_slot_operation_flag'] == 1 ? 1 : 0;
$smarty->assign('dont_show_popup_flag', $dont_show_popup_flag);

$company_data = $obj_company->get_company_detail($_SESSION['company_id']);

$flag_sign = 0;
if($_SESSION['user_role'] == 1)
    $smarty->assign('process_previlege', 1);
else
    $smarty->assign('process_previlege', $employee->has_privilege($_SESSION['user_id'], 'process'));

if (isset($_REQUEST['employee'])) {
    $cur_employee['userid'] = $_REQUEST['employee'];
    $emp = $employee->employee_data($_REQUEST['employee']);
    $cur_employee['name'] = $_SESSION['company_sort_by'] == 1 ? $emp['first_name'].' '.$emp['last_name'] : $emp['last_name'].' '.$emp['first_name'];
    $cur_employee['code'] = $emp['code'];
    $cur_employee['contract_week_hour'] = $employee->employee_contract_week_hour($cur_employee['userid'], $cur_date_YW);
    $cur_employee['week_worked_hour'] = $employee->employee_timetable_week_time($cur_employee['userid'], $cur_date_YW);
    
    //--------------------calculate work - contract values-----------------------------------
    //by shamsu
    $cur_employee['work_hours']['weekly_nomal'] = round($employee->employee_total_work_hours($cur_employee['userid'], 'year_week', $cur_date_YW, 0), 2);
    $cur_employee['work_hours']['weekly_oncall'] = round($employee->employee_total_work_hours($cur_employee['userid'], 'year_week', $cur_date_YW, 3), 2);
    $cur_employee['work_hours']['monthly_nomal'] = round($employee->employee_total_work_hours($cur_employee['userid'], 'year_month', $cur_date_Ym, 0), 2);
    $cur_employee['work_hours']['monthly_oncall'] = round($employee->employee_total_work_hours($cur_employee['userid'], 'year_month', $cur_date_Ym, 3), 2);
    
    $cur_employee_contracts = $obj_contract->get_employee_contract_records($cur_employee['userid'], 'date', $_REQUEST['date']);
    if(!empty($cur_employee_contracts)){
        $obj_general = new general();
        $cur_employee_contract_from = $cur_employee_contracts[0]['date_from'];
        $cur_employee_contract_to = $cur_employee_contracts[0]['date_to'];
        if(date('Y', strtotime($cur_employee_contract_from)) != $cur_date_Y)
                $cur_employee_contract_from = date('Y-01-01', $cur_date);
        if($cur_employee_contract_to == '' || date('Y', strtotime($cur_employee_contract_to)) != $cur_date_Y)
                $cur_employee_contract_to = date('Y-12-31', $cur_date);
        $cur_employee['work_hours']['contract_period_from'] = $cur_employee_contract_from;
        $cur_employee['work_hours']['contract_period_to'] = $cur_employee_contract_to;
        $cur_employee['work_hours']['contract_period_nomal'] = round($employee->employee_total_work_hours($cur_employee['userid'], 'date_between', $cur_employee_contract_from.'|'.$cur_employee_contract_to, 0), 2);
        $cur_employee['work_hours']['contract_period_oncall'] = round($employee->employee_total_work_hours($cur_employee['userid'], 'date_between', $cur_employee_contract_from.'|'.$cur_employee_contract_to, 3), 2);
        
        //--------------calculate maximum allowed contract hours------------------------------
        $cur_employee['contract_hours']['weekly_nomal'] = round($cur_employee_contracts[0]['hour'], 2);
        $cur_employee['contract_hours']['monthly_oncall'] = round($cur_employee_contracts[0]['monthly_oncall_hour'], 2);
        
        $this_month_start_date = date('Y-m-01', $cur_date);
        $this_month_end_date = date('Y-m-t', $cur_date);
        $month_working_days = $obj_contract->get_working_days($this_month_start_date, $this_month_end_date);
        $cur_employee['contract_hours']['monthly_nomal'] = round(($cur_employee_contracts[0]['hour'] / 5 * $month_working_days), 2);
        $cur_employee['contract_hours']['weekly_oncall'] = round(($cur_employee_contracts[0]['monthly_oncall_hour'] / $month_working_days * 5), 2);
        
        $contract_period_working_days = $obj_contract->get_working_days($cur_employee_contract_from, $cur_employee_contract_to);
        $cur_employee['contract_hours']['contract_period_nomal'] = round(($cur_employee_contracts[0]['hour'] / 5 * $contract_period_working_days), 2);
        
        $contract_period_months = $obj_general->get_months_between_dates($cur_employee_contract_from, $cur_employee_contract_to, 'Y-m-01');
        $contract_period_oncall_contracts = 0.00;
        if(!empty($contract_period_months)){
            foreach ($contract_period_months as $contract_period_month) {
                $this_month_start_date = date('Y-m-01', strtotime($contract_period_month));
                $this_month_end_date = date('Y-m-t', strtotime($contract_period_month));
                $this_month_working_days = $obj_contract->get_working_days($this_month_start_date, $this_month_end_date);
                
                $this_month_contract_from = $cur_employee_contract_from;
                $this_month_contract_to = $cur_employee_contract_to;
                if(date('Y|m', strtotime($cur_employee_contract_from)) != date('Y|m', strtotime($contract_period_month)))
                        $this_month_contract_from = date('Y-m-01', strtotime ($contract_period_month));
                if(date('Y|m', strtotime($cur_employee_contract_to)) != date('Y|m', strtotime($contract_period_month)))
                        $this_month_contract_to = date('Y-m-t', strtotime ($contract_period_month));
                $this_month_contract_working_days = $obj_contract->get_working_days($this_month_contract_from, $this_month_contract_to);
                $contract_period_oncall_contracts += $cur_employee_contracts[0]['monthly_oncall_hour'] / $this_month_working_days * $this_month_contract_working_days;
            }
        }
        
        $cur_employee['contract_hours']['contract_period_oncall'] = round($contract_period_oncall_contracts, 2);
    } else {
        //--------------calculate maximum allowed contract hours------------------------------
        $cur_employee['contract_hours']['weekly_nomal'] = round($company_data['weekly_hour'], 2);
        $cur_employee['contract_hours']['monthly_oncall'] = round($company_data['monthly_oncall_hour'], 2);
        
        $this_month_start_date = date('Y-m-01', strtotime($cur_date));
        $this_month_end_date = date('Y-m-t', strtotime($cur_date));
        $month_working_days = $obj_contract->get_working_days($this_month_start_date, $this_month_end_date);
        $cur_employee['contract_hours']['monthly_nomal'] = round(($company_data['weekly_hour'] / 5 * $month_working_days), 2);
        $cur_employee['contract_hours']['weekly_oncall'] = round(($company_data['monthly_oncall_hour'] / $month_working_days * 5), 2);
    }
    $smarty->assign('employee', $cur_employee);
}
if (isset($_REQUEST['customer'])) {
    $cur_customer['userid'] = $_REQUEST['customer'];
    $cust = $customer->customer_data($_REQUEST['customer']);
    $cur_customer['name'] = $_SESSION['company_sort_by'] == 1 ? $cust['first_name'].' '.$cust['last_name'] : $cust['last_name'].' '.$cust['first_name'];;
    $cur_customer['code'] = $cust['code'];
    $cur_customer['fkkn'] = $cust['fkkn'];
//    $cur_customer['contract_week_hour_fk'] = $customer->customer_contract_week_hour($cur_customer['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date), 1);
//    $cur_customer['week_worked_hour_fk'] = $customer->customer_timetable_week_time($cur_customer['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date), 1);
//    $cur_customer['contract_week_hour_kn'] = $customer->customer_contract_week_hour($cur_customer['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date), 2);
//    $cur_customer['week_worked_hour_kn'] = $customer->customer_timetable_week_time($cur_customer['userid'], date('Y', $cur_date) . '|' . date('W', $cur_date), 2);
    $smarty->assign('customer', $cur_customer);
    
    //--------------------calculate work - contract values-----------------------------------
    $customer_contract_hours = $customer_work_hours = array();

    $customer_contract_hours['fk']['week'] = $customer->customer_contract_week_hour($cur_customer['userid'], $cur_date_YW, 1);
    $customer_contract_hours['kn']['week'] = $customer->customer_contract_week_hour($cur_customer['userid'], $cur_date_YW, 2);

    $customer_work_hours['fk']['week'] = $customer->customer_timetable_week_time($cur_customer['userid'], $cur_date_YW, 1);
    $customer_work_hours['kn']['week'] = $customer->customer_timetable_week_time($cur_customer['userid'], $cur_date_YW, 2);
    
    $this_month_no = sprintf("%02d", $cur_date_m);
    $this_month_date_from = $cur_date_Y.'-'.$this_month_no.'-01';
    $this_month_date_to = date("Y-m-t", strtotime($this_month_date_from));
        
    $customer_work_hours['fk']['month'] = $customer->customer_timetable_time_between_dates($cur_customer['userid'], $this_month_date_from, $this_month_date_to, 1);
    $customer_work_hours['kn']['month'] = $customer->customer_timetable_time_between_dates($cur_customer['userid'], $this_month_date_from, $this_month_date_to, 2);
    
    $customer_contract_hours['fk']['month'] = $customer->customer_contract_month_hour($cur_customer['userid'], $cur_date_Ym, 1);
    $customer_contract_hours['kn']['month'] = $customer->customer_contract_month_hour($cur_customer['userid'], $cur_date_Ym, 2);
    
    $customer_contract_period_hours = array('fk' => array(), 'kn' => array());
    $customer_week_contracts_fk = $customer->customer_contract_week($cur_customer['userid'], $cur_date_YW, 1);
    if(!empty($customer_week_contracts_fk) && $customer_week_contracts_fk !== FALSE){
        $i = 0;
        foreach($customer_week_contracts_fk as $fk_contract){
            $customer_contract_period_hours['fk'][$i]['period_from']  = $fk_contract['date_from'];
            $customer_contract_period_hours['fk'][$i]['period_to']    = $fk_contract['date_to'];
            $customer_contract_period_hours['fk'][$i]['work_hours']   = $customer->customer_timetable_time_between_dates($cur_customer['userid'], $fk_contract['date_from'], $fk_contract['date_to'], 1);
            $customer_contract_period_hours['fk'][$i]['contract_hours'] = round($fk_contract['hour'], 2);
            $i++;
        }
    }
    $customer_week_contracts_kn = $customer->customer_contract_week($cur_customer['userid'], $cur_date_YW, 2);
    if(!empty($customer_week_contracts_kn) && $customer_week_contracts_kn !== FALSE){
        $i = 0;
        foreach($customer_week_contracts_kn as $kn_contract){
            $customer_contract_period_hours['kn'][$i]['period_from']  = $kn_contract['date_from'];
            $customer_contract_period_hours['kn'][$i]['period_to']    = $kn_contract['date_to'];
            $customer_contract_period_hours['kn'][$i]['work_hours']   = $customer->customer_timetable_time_between_dates($cur_customer['userid'], $kn_contract['date_from'], $kn_contract['date_to'], 2);
            $customer_contract_period_hours['kn'][$i]['contract_hours'] = round($kn_contract['hour'], 2);
            $i++;
        }
    }
    
    $contract_exist_flag = ($customer_work_hours['fk']['week'] != 0 || $customer_work_hours['kn']['week'] != 0 || 
            $customer_contract_hours['fk']['week'] != 0 || $customer_contract_hours['kn']['week'] != 0 ||
            $customer_work_hours['fk']['month'] != 0 || $customer_work_hours['kn']['month'] != 0 || 
            $customer_contract_hours['fk']['month'] != 0 || $customer_contract_hours['kn']['month'] != 0 ||
            !empty($customer_week_contracts_fk) || !empty($customer_week_contracts_kn)
            ? TRUE : FALSE);
    $smarty->assign('contract_exist_flag', $contract_exist_flag);
    $smarty->assign('customer_work_hours', $customer_work_hours);
    $smarty->assign('customer_contract_hours', $customer_contract_hours);
    $smarty->assign('customer_contract_period_hours', $customer_contract_period_hours);
}
if (isset($_REQUEST['employee']) && isset($_REQUEST['customer'])) {
    $flag_sign = $employee->chk_employee_rpt_signed($_REQUEST['employee'], $_REQUEST['customer'], $_REQUEST['date']);
}

$smarty->assign('flag_sign', $flag_sign);
$memory_slots = array();


/* ------------------------------- core process start here---------------------- */
if (isset($_REQUEST['employee']) && isset($_REQUEST['customer']) && $_REQUEST['employee'] != "" && $_REQUEST['customer'] != "") {
    
    $slot_detail =  $employee->timetable_customer_employee_slots($_REQUEST['customer'], $_REQUEST['employee'], $_REQUEST['date']);
    $smarty->assign('slot_details', $slot_detail);
    $memory_slots = $employee->get_memory_slots($_REQUEST['employee'], $_REQUEST['date'],$_REQUEST['customer']);
    
    $Allslot_remove_url = 'ajax_slot_process.php?date='.$_REQUEST['date'].'&emp_alloc='.$_SESSION['user_id'].'&customer='.$_REQUEST['customer'].'&employee='.$_REQUEST['employee'].'&action=slot_remove';
    $slot_copy_url = 'ajax_slot_process.php?date='.$_REQUEST['date'].'&emp_alloc='.$_SESSION['user_id'].'&customer='.$_REQUEST['customer'].'&employee='.$_REQUEST['employee'].'&action=copy';
    $slot_past_url = 'ajax_slot_process.php?date='.$_REQUEST['date'].'&emp_alloc='.$_SESSION['user_id'].'&customer='.$_REQUEST['customer'].'&employee='.$_REQUEST['employee'].'&action=paste';
    $slot_multicopy_url = 'gdschema_process_copy.php?date='.$_REQUEST['date'].'&emp_alloc='.$_SESSION['user_id'].'&customer='.$_REQUEST['customer'].'&employee='.$_REQUEST['employee'];
    $slot_schemadelete_url = 'gdschema_process_delete.php?date='.$_REQUEST['date'].'&customer='.$_REQUEST['customer'].'&employee='.$_REQUEST['employee'];
} 
else if (isset($_REQUEST['employee']) && !isset($_REQUEST['customer']) && $_REQUEST['employee'] != "" && $_REQUEST['customer'] == "") {
    $slot_detail =  $employee->timetable_customer_employee_slots('', $_REQUEST['employee'], $_REQUEST['date']);
    $smarty->assign('slot_details', $slot_detail);
    $memory_slots = $employee->get_memory_slots($_REQUEST['employee'], $_REQUEST['date']);
    
    $Allslot_remove_url = 'ajax_slot_process.php?date='.$_REQUEST['date'].'&emp_alloc='.$_SESSION['user_id'].'&employee='.$_REQUEST['employee'].'&action=slot_remove';
    $slot_copy_url = 'ajax_slot_process.php?date='.$_REQUEST['date'].'&emp_alloc='.$_SESSION['user_id'].'&employee='.$_REQUEST['employee'].'&action=copy';
    $slot_past_url = 'ajax_slot_process.php?date='.$_REQUEST['date'].'&emp_alloc='.$_SESSION['user_id'].'&employee='.$_REQUEST['employee'].'&action=paste';
    $slot_multicopy_url = 'gdschema_process_copy.php?date='.$_REQUEST['date'].'&emp_alloc='.$_SESSION['user_id'].'&employee='.$_REQUEST['employee'];
    $slot_schemadelete_url = 'gdschema_process_delete.php?date='.$_REQUEST['date'].'&employee='.$_REQUEST['employee'];
} 
else if (!isset($_REQUEST['employee']) && isset($_REQUEST['customer']) && $_REQUEST['customer'] != "" && (!isset($_REQUEST['employee']) || $_REQUEST['employee'] == "")) {
    //print_r($obj_emp->get_available_users('1', '14', '14.30', '2012-03-14'));
    $slot_detail =  $employee->timetable_customer_employee_slots($_REQUEST['customer'], '', $_REQUEST['date']);
//    echo "<pre>". print_r($slot_detail, 1)."</pre>";
    $smarty->assign('slot_details',$slot_detail);
   if($_SESSION['user_role'] == 3){
        $memory_slots =  $employee->get_memory_slots($_SESSION['user_id'], $_REQUEST['date'], $_REQUEST['customer']);
    }else{
        $memory_slots = $customer->get_memory_slots($_REQUEST['customer'], $_REQUEST['date']);
    }
    
    $Allslot_remove_url = 'ajax_slot_process.php?date='.$_REQUEST['date'].'&emp_alloc='.$_SESSION['user_id'].'&customer='.$_REQUEST['customer'].'&action=slot_remove';
    $slot_copy_url = 'ajax_slot_process.php?date='.$_REQUEST['date'].'&emp_alloc='.$_SESSION['user_id'].'&customer='.$_REQUEST['customer'].'&action=copy';
    $slot_past_url = 'ajax_slot_process.php?date='.$_REQUEST['date'].'&emp_alloc='.$_SESSION['user_id'].'&customer='.$_REQUEST['customer'].'&action=paste';
    $slot_multicopy_url = 'gdschema_process_copy.php?date='.$_REQUEST['date'].'&emp_alloc='.$_SESSION['user_id'].'&customer='.$_REQUEST['customer'];
    $slot_schemadelete_url = 'gdschema_process_delete.php?date='.$_REQUEST['date'].'&customer='.$_REQUEST['customer'];
}

/* ------------------------------- core process endz here---------------------- */

/* ------------------------------- action button url's asper week basis---------------------- */
$smarty->assign('Allslot_remove_url',$Allslot_remove_url);
$smarty->assign('slot_copy_url',$slot_copy_url);
$smarty->assign('slot_past_url',$slot_past_url);
$smarty->assign('slot_multicopy_url',$slot_multicopy_url);
$smarty->assign('slot_schemadelete_url',$slot_schemadelete_url);
/* ------------------------------- action button url's asper week basis endz---------------------- */


/* ------------------------------- getting extra details for only leave slots ---------------------- */
$count_slot_detail = count($slot_detail);
$count_memory_slots = count($memory_slots);
$leave_slot_ids = array();
for($i=0 ; $i<$count_slot_detail ; $i++){
    if($slot_detail[$i]['status'] == 2){ //getting leave slots only
        $leave_slot_ids[] = $slot_detail[$i]['id'];
        $leave_data = $employee->get_leave_details_byTimeTable_data($slot_detail[$i]['employee'],$slot_detail[$i]['date'],$slot_detail[$i]['slot_from'],$slot_detail[$i]['slot_to']);
        $slot_detail[$i]['leave_data'] = $leave_data[0];
        $slot_detail[$i]['leave_data']['leave_name'] = $smarty->leave_type[$leave_data[0]['type']];
        
        // $related_slot = $employee->check_relations_in_timetable_for_leave($slot_detail[$i]['id']);
        // if(!empty($related_slot))
        //     $slot_detail[$i]['leave_data']['is_exist_relation'] = 1;
        // else
        //     $slot_detail[$i]['leave_data']['is_exist_relation'] = 0;
    }
}

//check having cloned slot for each leave slots
if(!empty($leave_slot_ids)){
    $related_slots = $employee->check_relations_in_timetable_for_leave($leave_slot_ids, TRUE);
    $indexed_leave_related_slot_details = array();
    if(!empty($related_slots)){
        foreach ($related_slots as $rs) {
            $indexed_leave_related_slot_details[$rs['relation_id']] = $rs['id'];
        }
    }
    for($i=0 ; $i<$count_slot_detail ; $i++){
        if($slot_detail[$i]['status'] == 2){
            $slot_detail[$i]['leave_data']['is_exist_relation'] = !empty($indexed_leave_related_slot_details) && isset($indexed_leave_related_slot_details[$slot_detail[$i]['id']]) ? 1 : 0;
        }
    }
}
//echo "<pre>".print_r($slot_detail, 1)."</pre>";

/* ------------------------------- getting extra leave slot details--endz-------------------- */

/*--------------------- Removing duplicate slots for employee------*/

if($_SESSION['user_role'] == 3){
    $prev = array();
    for($i=0;$i<count($slot_detail);$i++){
        if($slot_detail[$i]['status'] == 0){
            for($j=$i-1;$j>=0;$j--){
                if($slot_detail[$j]['status'] == 1){
                        if((($slot_detail[$i]['slot_from'] >= $slot_detail[$j]['slot_from'] && $slot_detail[$i]['slot_from'] < $slot_detail[$j]['slot_to']) || ($slot_detail[$i]['slot_to'] > $slot_detail[$j]['slot_from'] && $slot_detail[$i]['slot_to'] <= $slot_detail[$j]['slot_to']) || ($slot_detail[$i]['slot_from'] < $slot_detail[$j]['slot_from'] && $slot_detail[$i]['slot_to'] > $slot_detail[$j]['slot_to']))  && $slot_detail[$j]['employee'] == $_SESSION['user_id']){
                        $prev[] = $i;
                    }
                }
            }
            for($j=$i+1;$j<count($slot_detail);$j++){
                if($slot_detail[$j]['status'] == 1){
                    if((($slot_detail[$i]['slot_from'] >= $slot_detail[$j]['slot_from'] && $slot_detail[$i]['slot_from'] < $slot_detail[$j]['slot_to']) || ($slot_detail[$i]['slot_to'] > $slot_detail[$j]['slot_from'] && $slot_detail[$i]['slot_to'] <= $slot_detail[$j]['slot_to']) || ($slot_detail[$i]['slot_from'] < $slot_detail[$j]['slot_from'] && $slot_detail[$i]['slot_to'] > $slot_detail[$j]['slot_to']))  && $slot_detail[$j]['employee'] == $_SESSION['user_id']){
                        $prev[] = $i;
                    }
                }
            }
        }
    }
//    echo "<pre>".print_r($prev, 1)."</pre>";
    for($i=0;$i<count($prev);$i++){
        unset($slot_detail[$prev[$i]]); 
    }
}
/*--------------------- Removing duplicate slots for employee end------*/
//echo "<pre>".print_r($slot_detail, 1)."</pre>";

/* ------------------------------- work slot seperation---------------------- */
$count_slot_detail = count($slot_detail);
$no_of_slot_entries_for_first_column= ceil($count_slot_detail/2);
$slot_entries_for_first_column = array();
$slot_entries_for_second_column = array();
if($count_slot_detail <= 6){
    $slot_entries_for_first_column = $slot_detail;
}else{
    $slot_entries_for_first_column = array_slice($slot_detail, 0,$no_of_slot_entries_for_first_column);
    $slot_entries_for_second_column = array_slice($slot_detail, $no_of_slot_entries_for_first_column);
}
//echo "<pre>".print_r($slot_entries_for_first_column, 1)."</pre>";
//echo "<pre>".print_r($slot_entries_for_second_column, 1)."</pre>";
$smarty->assign('slot_entries_for_first_column',$slot_entries_for_first_column);
$smarty->assign('slot_entries_for_second_column',$slot_entries_for_second_column);
/* ------------------------------- work slot seperation end---------------------- */

$smarty->assign('flag_copy', 0);
if(count($slot_detail))
    $smarty->assign('flag_copy', 1);
$smarty->assign('flag_paste',0);
if($obj_user->retrieve_from_temp_session(1) != '' && $flag_sign == 0){
    $smarty->assign('flag_paste',1);
}

/* ------------------------------- memory slot---------------------- */
$i=0;
$j = 1;
$memory_slots1 = array();
$memory_slots2 = array();
$memory_slots3 = array();
if($count_memory_slots <= 28){
    $memory_count = ceil(count($memory_slots)/2);
    foreach ($memory_slots as $memory_slot){
        if($i == $memory_count){
            $j++;
            $memory_count += ceil((count($memory_slots) - $memory_count)/(3-$j));
        }
        if($j == 1)
            $memory_slots1[] = $memory_slot;
        else if($j == 2)
            $memory_slots2[] = $memory_slot;
        $i++;
    }
    $smarty->assign('memory_slots1', $memory_slots1);
    $smarty->assign('memory_slots2', $memory_slots2);
}else{
    $memory_count = ceil(count($memory_slots)/3);
    foreach ($memory_slots as $memory_slot){
        if($i == $memory_count){
            $j++;
            $memory_count += ceil((count($memory_slots) - $memory_count)/(4-$j));
        }
        if($j == 1)
            $memory_slots1[] = $memory_slot;
        else if($j == 2)
            $memory_slots2[] = $memory_slot;
        else if($j == 3)
            $memory_slots3[] = $memory_slot;
        $i++;
    }
    $smarty->assign('memory_slots1', $memory_slots1);
    $smarty->assign('memory_slots2', $memory_slots2);
    $smarty->assign('memory_slots3', $memory_slots3);
}
/* ------------------------------- memory slot end---------------------- */



$employees_customer = $team->employees_for_customer_team_gdschema_alloc($_REQUEST['customer'],$_REQUEST['date']);


$dont_show_popup_delete_flag = 0;   //common delete flag to identify dont_show popup
//add an additional flag to each employees( to assign) to identify dont_show popup flag
if(!empty($employees_customer)){
    $count_employees_to_assign = count($employees_customer);
    for($b = 0 ; $b < $count_employees_to_assign ; $b++){
        $_this_general_setting_cust_employee = $employee->get_customer_employee_general_setting($__slot_customer, $employees_customer[$b]['username'], 'dont_show_slot_operation_flag');
        $employees_customer[$b]['dont_popup_flag'] = !empty($_this_general_setting_cust_employee) && $_this_general_setting_cust_employee[0]['dont_show_slot_operation_flag'] == 1 ? 1 : 0;
        $dont_show_popup_delete_flag = $employees_customer[$b]['dont_popup_flag'] == 1 ? 1 : $dont_show_popup_delete_flag;
    }
}

$dont_show_popup_delete_flag = $dont_show_popup_delete_flag == 1 || $dont_show_popup_flag == 1 ? 1 : 0;
$smarty->assign('dont_show_popup_delete_flag', $dont_show_popup_delete_flag);


/* ------------------- getting company details - for getting contract hour flag---------------------- */
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
/* ------------------- getting company details - for getting contract hour flag-----------endz----------- */

//echo "<pre>". print_r($employees_customer, 1)."</pre>";
//echo "<pre>".print_r($employees_customer, 1)."</pre>";
$customers_of_employee = $team->customers_for_employee_team_gdschema_alloc((isset($_REQUEST['employee']) ? $_REQUEST['employee'] : ''),$_REQUEST['date']);
$smarty->assign('employees_to_assign', $employees_customer);
$smarty->assign('json_employees_to_assign', json_encode($employees_customer));
$smarty->assign('customers_to_assign', $customers_of_employee);
$smarty->assign('count_employees_to_assign', count($employees_customer));
$smarty->assign('count_customers_to_assign', count($customers_of_employee));
$smarty->assign('emp_role',$_SESSION['user_role']);
$smarty->assign('copy_var', $obj_user->retrieve_from_temp_session(1));

if(isset($_REQUEST['right_panel']) && $_REQUEST['right_panel'] != ''){
    $smarty->assign('right_panel', $_REQUEST['right_panel']);   //memory_slots
}else if(isset($_COOKIE['day_view_active_side_tab']) && $_COOKIE['day_view_active_side_tab'] != ''){
    switch ($_COOKIE['day_view_active_side_tab']){
        case 'tab-assign-emp-list'  : $smarty->assign('right_panel', 'emp_assign_list'); break;
        case 'tb_create_slot'       : $smarty->assign('right_panel', 'create_new_slot'); break;
        case 'tb_mem_slots'         : $smarty->assign('right_panel', 'memory_slots'); break;
    }
}
$smarty->assign('swap_copied_slot', isset($_SESSION['swap']) ? $_SESSION['swap'] : '');

$search_customers = $customer->customers_list_for_employee_report();
$smarty->assign('search_customers', $search_customers);

$righclick_employees_for_goto = $employee->employees_list_for_right_click($_REQUEST['customer']);
$smarty->assign('righclick_employees_for_goto', $righclick_employees_for_goto);


$smarty->assign('today_date', date('Y-m-d'));
if(date('Y-m-d') == $_REQUEST['date']){
    $obj_timetable  = new timetable();
    $customer_running_tasks = $obj_timetable->get_customer_running_tasks($_REQUEST['customer']);
    $smarty->assign('customer_running_tasks', $customer_running_tasks);
}
else{
    $smarty->assign('customer_running_tasks', array());
}
$smarty->assign('company_id', $_SESSION['company_id']);

$smarty->display('gdschema_alloc_window.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|gdschema_alloc_window.tpl');
?>