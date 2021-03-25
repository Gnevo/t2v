<?php
/**
 * @author: Shamsudheen <shamsu@arioninfotech.com>
 * @description : Month view of timeslots
 * @since 2014-03-29
*/
require_once('class/setup.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');
require_once('plugins/calender.class.php');
require_once('class/employee.php');
require_once('class/timetable.php');
require_once('class/company.php');
//require_once('class/newcustomer.php');
require_once ('class/contract.php');
//require_once ('plugins/date_calc.class.php');
require_once ('class/team.php');
require_once('class/newcustomer.php');
$smarty         = new smartySetup(array("gdschema.xml", "month.xml","messages.xml",'user.xml', 'button.xml', 'tooltip.xml', 'contract.xml', 'reports.xml', 'mail.xml'),FALSE);
$obj_customer   = new customer();
$obj_msg        = new message();
$obj_calender   = new calender();
$obj_timetable  = new timetable();
$obj_employee   = new employee();
$obj_company   = new company();
//$obj_newCustomer = new newcustomer();
$obj_contract = new contract();
$obj_newcustomer = new newcustomer();

//$obj_date = new datecalc();
$obj_team = new team();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
//echo "<pre>".print_r($_REQUEST, 1)."</pre>";
$query_string = explode('&', $_SERVER['QUERY_STRING']);
$selected_year = trim($query_string[0]); //year
$selected_month = trim($query_string[1]); //month
$selected_employee = trim($query_string[2]); //employee


$selected_customer = isset($query_string[4]) ? trim($query_string[4]) : ''; //customer
$holidays = $obj_employee->get_holiday_details($selected_month, $selected_year, true); 
/*$rpt_page_url = (isset($query_string[3]) && trim($query_string[3]) == 'mc_leave') 
        ? $smarty->url . "message/center/leave/$selected_month/$selected_year/NULL/NULL/"
        : NULL;*/
$rpt_page_url = NULL;
if(isset($query_string[3]) && trim($query_string[3]) != ''){
    switch(trim($query_string[3])){
        case 'mc_leave' :
            $rpt_page_url = $smarty->url . "message/center/leave/$selected_month/$selected_year/NULL/NULL/";
            break;
        case 'CUST_ADD' :
            $rpt_page_url = $smarty->url . "customer/add/$selected_customer/";
            break;
    }
}
if($rpt_page_url && (!isset($_SESSION['report_return_url']) || $_SESSION['report_return_url'] == '')){
    $_SESSION['report_return_url'] = $rpt_page_url;
    $_SESSION['from_page'] = trim($query_string[3]);
} 
$smarty->assign('from_page', isset($_SESSION['from_page']) ? $_SESSION['from_page'] : '');
$smarty->assign('rpt_page_url',  isset($_SESSION['report_return_url']) ? $_SESSION['report_return_url'] : '');
$smarty->assign('flag_emp_access', $obj_employee->is_employee_accessible($selected_employee) ? 1 : 0);
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('login_user_role', $_SESSION['user_role']);
$smarty->assign('selected_employee', $selected_employee);
$smarty->assign('selected_month', $selected_month);
$smarty->assign('selected_year', $selected_year);
$smarty->assign('holidays', $holidays);

$strtotime_prv_year_month = strtotime($selected_year .'-'. $selected_month . '-01' . ' -1 month');
$strtotime_next_year_month = strtotime($selected_year .'-'. $selected_month . '-01' . ' +1 month');
$prv_month  = date('m', $strtotime_prv_year_month);
$prv_year   = date('Y', $strtotime_prv_year_month);
$next_month = date('m', $strtotime_next_year_month);
$next_year  = date('Y', $strtotime_next_year_month);
$smarty->assign('prv_month', $prv_month);
$smarty->assign('prv_year', $prv_year);
$smarty->assign('next_month', $next_month);
$smarty->assign('next_year', $next_year);
$smarty->assign('today_year', date('Y'));
$smarty->assign('today_month', date('m'));
$smarty->assign('today_date', date('Y-m-d'));

$months = $obj_calender->get_months();
$smarty->assign('weeks', $obj_calender->get_weeks());
$smarty->assign('months', $months);
$month_label = $months[((int) $selected_month - 1)]['month'];
$smarty->assign('month_label', $month_label);

$employee_details = $obj_employee->employee_data($selected_employee);
$smarty->assign('employee_details', $employee_details);
    
$search_employees = $obj_employee->employees_list_for_right_click($selected_employee);
$smarty->assign('search_employees', $search_employees);

//additional datas for monthly view from day view-----------------------
$smarty->assign('leave_types', $smarty->leave_type);
$smarty->assign('no_of_weeks',52);
//$memory_slots =  $obj_employee->get_all_customer_memory_slots($selected_employee);
//$smarty->assign('memory_slots', $memory_slots);
//additional datas for monthly view from day view------endz-----------------

//get calendar days in selected month
$month_weeks = $obj_calender->calender_month($selected_year, $selected_month, 01);

//echo "<pre>".print_r($month_weeks, 1)."</pre>";

/* get customer slots starts */
$month_sdate = date('Y-m-d', strtotime($selected_year .'-'. $selected_month . '-01'));
$month_edate = date('Y-m-t', strtotime($selected_year .'-'. $selected_month . '-01'));
//$obj_employee->employee_slots_week($employee_username, $year_week);
//echo "<pre>".print_r($_SESSION, 1)."</pre>";
$selected_month_slots = $obj_timetable->employee_slots_btwn_dates($selected_employee, $month_sdate, $month_edate);
$selected_month_day_slots = array();
if(!empty($selected_month_slots)){
    //calculate employee work report summery
    $process_normal_slot_types = array(0,1,2,4,5,6,7,8,10,11,12);
    $process_oncall_slot_types = array(3,9,13,14);
    foreach ($selected_month_slots as $slot) {
        if($slot['status'] == 1 && $slot['employee'] != ''){
            //if employee is logged in, allow only his own slots
            if($_SESSION['user_role'] == 3 && $_SESSION['user_id'] != $slot['employee']) continue;
        }
    }
    
    //finding leave details only for leave slots
    $leave_slot_ids = array();
    foreach ($selected_month_slots as $key => $slot) {
        if($slot['status'] == 2){ //getting leave slots only
            $leave_slot_ids[] = $slot['id'];
            $temp_leave_data = $obj_employee->get_leave_details_byTimeTable_data($slot['employee'], $slot['date'], $slot['time_from'], $slot['time_to']);
            $selected_month_slots[$key]['leave_data'] = $temp_leave_data[0];
            $selected_month_slots[$key]['leave_data']['leave_name'] = $smarty->leave_type[$temp_leave_data[0]['type']];
        
            // $related_slot = $obj_employee->check_relations_in_timetable_for_leave($slot['id']);
            // if(!empty($related_slot))
            //     $selected_month_slots[$key]['leave_data']['is_exist_relation'] = 1;
            // else
            //     $selected_month_slots[$key]['leave_data']['is_exist_relation'] = 0;
        }
    }

    //check having cloned slot for each leave slots
    if(!empty($leave_slot_ids)){
        $related_slots = $obj_employee->check_relations_in_timetable_for_leave($leave_slot_ids, TRUE);
        $indexed_leave_related_slot_details = array();
        if(!empty($related_slots)){
            foreach ($related_slots as $rs) {
                $indexed_leave_related_slot_details[$rs['relation_id']] = $rs['id'];
            }
        }
        foreach ($selected_month_slots as $key => $slot) {
            if($slot['status'] == 2){
                $selected_month_slots[$key]['leave_data']['is_exist_relation'] = !empty($indexed_leave_related_slot_details) && isset($indexed_leave_related_slot_details[$slot['id']]) ? 1 : 0;
            }
        }
    }
    
    //grouping as per day slots
    foreach ($selected_month_slots as $slot)
        $selected_month_day_slots[$slot['date']][] = $slot;
}
if(!empty($month_weeks)){
    foreach($month_weeks as $wkey => $month_week){
        if(!empty($month_week['days'])){
            foreach($month_week['days'] as $dkey => $week_day){
                
                if(isset($selected_month_day_slots[$week_day['date']]) && !empty($selected_month_day_slots[$week_day['date']]))
                    $month_weeks[$wkey]['days'][$dkey]['slots'] = $selected_month_day_slots[$week_day['date']];
                else
                    $month_weeks[$wkey]['days'][$dkey]['slots'] = array();
            }
        }
    }
}

//echo "<pre>month_weeks".print_r($month_weeks, 1)."</pre>"; exit();
$smarty->assign('month_weeks', $month_weeks);
/* get customer slots endz */

/* calculate contract hours */
$work_hours = $contract_hours = array();
$year_month = $selected_year.'|'.$selected_month;
$work_hours['monthly_nomal'] = round($obj_employee->employee_total_work_hours($selected_employee, 'year_month', $year_month, 0), 2);
$work_hours['monthly_oncall']= round($obj_employee->employee_total_work_hours($selected_employee, 'year_month', $year_month, 3), 2);

$cur_employee_contracts = $obj_contract->get_employee_contract_records($selected_employee, 'year_month', $year_month);
$month_working_days = $obj_contract->get_working_days($month_sdate, $month_edate);
$contract_hours['monthly_nomal'] = !empty($cur_employee_contracts) ? round(($cur_employee_contracts[0]['hour'] / 5 * $month_working_days), 2) : 0;
$contract_hours['monthly_oncall'] = !empty($cur_employee_contracts) ? round($cur_employee_contracts[0]['monthly_oncall_hour'], 2) : 0;
$smarty->assign('contract_hours', $contract_hours);
$smarty->assign('work_hours', $work_hours);
/* calculate contract hours endz */

//employees customers whos was not signed
$non_signed_customers_of_employee = $obj_team->customers_for_employee_team_gdschema_alloc($selected_employee, $month_sdate);
$smarty->assign('non_signed_customers_of_employee', $non_signed_customers_of_employee);
//all customers of this employees (not checking signing)
$all_customers_of_employee = $obj_employee->get_team_customers_of_employee($selected_employee);
$smarty->assign('all_customers_of_employee', $all_customers_of_employee);

//----------------------------------------------------------------------------------
//getting previleges
$smarty->assign('privileges_gd',$obj_employee->get_privileges($_SESSION['user_id'], 1));
//echo "<pre>".print_r($obj_employee->get_privileges($_SESSION['user_id'], 1), 1)."</pre>";
$smarty->assign('privileges_mc', $obj_employee->get_privileges($_SESSION['user_id'], 3));
$smarty->assign('privileges_general', $obj_employee->get_privileges($_SESSION['user_id'], 2));

/* ------------------- getting company details - for getting contract hour flag---------------------- */
$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
/* ------------------- getting company details - for getting contract hour flag-----------endz----------- */


$smarty->assign('show_right_panel', false);
if(isset($_REQUEST['show_right_panel']) && $_REQUEST['show_right_panel'] && isset($_REQUEST['right_panel']) && $_REQUEST['right_panel'] != ''){
    $smarty->assign('show_right_panel', true);
    $smarty->assign('right_panel', $_REQUEST['right_panel']);   //memory_slots
//    echo "<pre>".print_r($_REQUEST, 1)."</pre>";
}

$righclick_customers_for_goto = $obj_customer->customer_list();
$smarty->assign('righclick_customers_for_goto', $righclick_customers_for_goto);

if(date('Y-m') == $selected_year.'-'.str_pad($selected_month,2,'0',STR_PAD_LEFT)){
    $employee_running_tasks = $obj_timetable->get_employee_running_tasks($selected_employee);
    $smarty->assign('employee_running_tasks', $employee_running_tasks);
}
else{
    $smarty->assign('employee_running_tasks', array());
}

$employee_last_template_id = $obj_newcustomer->check_exist_employee_template_id($selected_employee);
$smarty->assign('employee_last_template_id', $employee_last_template_id);

$employee_schedule_main_details = $employee_last_template_id !== FALSE ? $obj_newcustomer->get_employee_template_main_by_id($employee_last_template_id) : array();
$smarty->assign('employee_schedule_main_details', $employee_schedule_main_details);
//echo "<pre>".print_r($employee_schedule_main_details, 1)."</pre>";

$smarty->assign('message', $obj_msg->show_message());
$smarty->assign('company_id', isset($_SESSION['company_id']) ? $_SESSION['company_id'] : '');
$smarty->assign('swap_copied_slot', isset($_SESSION['swap']) ? $_SESSION['swap'] : '');
//echo "<pre>".print_r($_SESSION, 1)."</pre>";
$smarty->display('gdschema_month_employee.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|gdschema_month.tpl');
?>