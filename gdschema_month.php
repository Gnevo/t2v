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
require_once('class/newcustomer.php');
require_once('class/contract.php');
//require_once ('plugins/date_calc.class.php');
//require_once ('class/team.php');
$smarty         = new smartySetup(array("gdschema.xml", "month.xml","messages.xml",'user.xml', 'button.xml', 'tooltip.xml', 'contract.xml', 'reports.xml', 'mail.xml'),FALSE);
$obj_customer    = new customer();
$obj_msg         = new message();
$obj_calender    = new calender();
$obj_timetable   = new timetable();
$obj_employee    = new employee();
$obj_company     = new company();
$obj_newCustomer = new newcustomer();
$obj_contract = new contract();

//$obj_date = new datecalc();
//$team = new team();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);
$query_string      = explode('&', $_SERVER['QUERY_STRING']);
$selected_year     = trim($query_string[0]); //trim($_GET['year']);
$selected_month    = trim($query_string[1]); //trim($_GET['month']);
$selected_customer = trim($query_string[2]); //trim($_GET['customer']);

$selected_employee = isset($query_string[3]) ? trim($query_string[3]) : '';  

$holidays = $obj_employee->get_holiday_details($selected_month, $selected_year, true);
$fkkn_val='';
$fkkn_ar = [];
if($selected_employee != ''){
 if(strpos($selected_employee, 'fkkn')) {
    $fkkn_val = explode(',',$selected_employee);
    if (($key = array_search('fkkn', $fkkn_val)) !== false) {
        unset($fkkn_val[$key]);
        $fkkn_ar = $fkkn_val;
    }
 }
}
/*$rpt_page_url = (isset($query_string[4]) && trim($query_string[4]) == 'emp_work_report'  && trim($query_string[3]) != '') 
        ? $smarty->url . "report/work/employee/detail/$selected_year/$selected_month/$selected_employee/$selected_customer/"
        : (isset($query_string[4]) && trim($query_string[4]) == 'mc_leave'  && trim($query_string[3]) != '')? $smarty->url . "message/center/leave/$selected_month/$selected_year/NULL/NULL/":NULL;*/

$rpt_page_url = NULL;
if(isset($query_string[4]) && trim($query_string[4]) != '' && trim($query_string[3]) != ''){
    switch(trim($query_string[4])){
        case 'emp_work_report' :
            $rpt_page_url = $smarty->url . "report/work/employee/detail/$selected_year/$selected_month/$selected_employee/$selected_customer/";
            break;
        case 'mc_leave' :
            $rpt_page_url = $smarty->url . "message/center/leave/$selected_month/$selected_year/NULL/NULL/";
            break;
        case 'EMP_ADD' :
            $rpt_page_url = $smarty->url . "employee/add/$selected_employee/";
            break;
    }
}
if($rpt_page_url && !isset($_SESSION['report_return_url'])){
    $_SESSION['report_return_url'] = $rpt_page_url;
    $_SESSION['from_page'] = trim($query_string[4]);
}    
$smarty->assign('from_page', isset($_SESSION['from_page']) ? $_SESSION['from_page'] : '');
$smarty->assign('selected_employee', $selected_employee);
$smarty->assign('rpt_page_url', isset($_SESSION['report_return_url']) ? $_SESSION['report_return_url'] : '');

$smarty->assign('flag_cust_access', $obj_customer->is_customer_accessible($selected_customer) ? 1 : 0);
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('login_user_role', $_SESSION['user_role']);
$smarty->assign('selected_customer', $selected_customer);
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

$customer_details = $obj_customer->customer_data($selected_customer);
//echo "customer<pre>".print_r($customer_details, 1)."</pre>";
$smarty->assign('customer_details', $customer_details);
    
//$search_customers = $obj_customer->customers_list_for_employee_report(-1);
$search_customers = $obj_customer->customers_list_for_employee_report();
$smarty->assign('search_customers', $search_customers);

//additional datas for monthly view from day view-----------------------
//echo "<pre>";print_r($smarty);exit();
$smarty->assign('leave_types', $smarty->leave_type);
$smarty->assign('no_of_weeks',52);
$memory_slots =  $obj_employee->get_all_customer_memory_slots($selected_customer);
$smarty->assign('memory_slots', $memory_slots);
//additional datas for monthly view from day view------endz-----------------


//get calendar days in selected month
$month_weeks = $obj_calender->calender_month($selected_year, $selected_month, 01);

//echo "<pre>".print_r($month_weeks, 1)."</pre>"; 

// get customer slots starts 
$month_sdate = date('Y-m-d', strtotime($selected_year .'-'. $selected_month . '-01'));
$month_edate = date('Y-m-t', strtotime($selected_year .'-'. $selected_month . '-01'));
$smarty->assign('month_sdate',$month_sdate);
$smarty->assign('month_edate',$month_edate);
$smarty->assign('fkkn_ar',$fkkn_ar);
$selected_month_slots = $obj_timetable->customer_slots_btwn_dates($selected_customer, $month_sdate, $month_edate, array(),$fkkn_ar);
//echo "<pre>";print_r($selected_month_slots);exit();
$selected_month_day_slots = $employee_work_summery_array = array();
if(!empty($selected_month_slots)){
    //calculate employee work report summery
    $process_normal_slot_types = array(0,1,2,4,5,6,7,8,10,11,12);
    $process_oncall_slot_types = array(3,9,13,14);
    foreach ($selected_month_slots as $slot) {
        if($slot['status'] == 1 && $slot['employee'] != ''){
            //if employee is logged in, allow only his own slots
            if($_SESSION['user_role'] == 3 && $_SESSION['user_id'] != $slot['employee']) continue;
            
            if(!isset($employee_work_summery_array[$slot['employee']]) || empty($employee_work_summery_array[$slot['employee']])){
                $employee_work_summery_array[$slot['employee']] = array(
                    'employee_name' => $slot['emp_last_name'].' '.$slot['emp_first_name'],
                    'normal' => 0, 
                    'oncall' => 0);
            }
            
            if(in_array($slot['type'], $process_normal_slot_types))
                $employee_work_summery_array[$slot['employee']]['normal'] += $slot['slot_hour'];
            else if(in_array($slot['type'], $process_oncall_slot_types))
                $employee_work_summery_array[$slot['employee']]['oncall'] += $slot['slot_hour'];
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
        
            // $related_slot = $obj_employee->check_relations_in_timetable_for_leave($slot['id'], TRUE);
            // $selected_month_slots[$key]['leave_data']['is_exist_relation'] = !empty($related_slot) ? 1 : 0;
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
// get customer slots endz 


// ------------------- getting company details - for getting contract hour flag---------------------- 
$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
// ------------------- getting company details - for getting contract hour flag-----------endz----------- 


//echo "<pre>employee_work_summery_array".print_r($employee_work_summery_array, 1)."</pre>";
if(!empty($employee_work_summery_array)){
    $year_month = $selected_year .'|'. $selected_month;
    foreach ($employee_work_summery_array as $emp_key => $summery_data) {

        $employee_contracts = $obj_contract->get_employee_contract_records($emp_key, 'year_month', $year_month);

        $emp_normal_contract_hours_for_this_month = $obj_employee->employee_contract_monthly_normal_hour($emp_key, $year_month, TRUE, $company_data, $employee_contracts);
        $emp_oncall_contract_hours_for_this_month = $obj_employee->employee_contract_oncall_monthly_hour($emp_key, $year_month, TRUE, $company_data, $employee_contracts);
        $employee_work_summery_array[$emp_key]['monthly_normal_contract_hours'] = $emp_normal_contract_hours_for_this_month;
        $employee_work_summery_array[$emp_key]['monthly_oncall_contract_hours'] = $emp_oncall_contract_hours_for_this_month;
        
        
        $employee_work_summery_array[$emp_key]['normal_percentage'] = $emp_normal_contract_hours_for_this_month != 0 ? (sprintf('%.02f', round($summery_data['normal'] * 100 / $emp_normal_contract_hours_for_this_month, 2))) : '0.00';
        $employee_work_summery_array[$emp_key]['oncall_percentage'] = $emp_oncall_contract_hours_for_this_month != 0 ? (sprintf('%.02f', round($summery_data['oncall'] * 100 / $emp_oncall_contract_hours_for_this_month, 2))) : '0.00';
        
        //formating values
        $employee_work_summery_array[$emp_key]['normal'] = sprintf('%.02f', round($employee_work_summery_array[$emp_key]['normal'], 2));
        $employee_work_summery_array[$emp_key]['oncall'] = sprintf('%.02f', round($employee_work_summery_array[$emp_key]['oncall'], 2));
        
    }
}
$smarty->assign('employee_work_summery_array', $employee_work_summery_array);

// calculate contract hours 
$customer_hours = array();

$selected_Ym = date('Y|m', strtotime($month_sdate));
//user_role = 3 (employee) gets only his work work hours with selected customers only
if($_SESSION['user_role'] == 3){
    $customer_hours['work']['customer_hours'] = $obj_customer->customer_empoyee_timetable_time_between_dates($month_sdate, $month_edate, $selected_customer, $_SESSION['user_id']);
    $customer_hours['work']['total_hours'] = $obj_customer->customer_empoyee_timetable_time_between_dates($month_sdate, $month_edate, NULL, $_SESSION['user_id']);
}
else{
    $customer_hours['work']['fk'] = $obj_customer->customer_timetable_time_between_dates($selected_customer, $month_sdate, $month_edate, 1, FALSE, TRUE);
    $customer_hours['work']['kn'] = $obj_customer->customer_timetable_time_between_dates($selected_customer, $month_sdate, $month_edate, 2, FALSE, TRUE);
    $customer_hours['work']['tu'] = $obj_customer->customer_timetable_time_between_dates($selected_customer, $month_sdate, $month_edate, 3, FALSE, TRUE);

    $customer_hours['contract']['fk'] = $obj_customer->customer_contract_month_hour($selected_customer, $selected_Ym, 1, TRUE);
    $customer_hours['contract']['kn'] = $obj_customer->customer_contract_month_hour($selected_customer, $selected_Ym, 2, TRUE);
    $customer_hours['contract']['tu'] = $obj_customer->customer_contract_month_hour($selected_customer, $selected_Ym, 3, TRUE);

    $temp_actual_hours_fk = $obj_customer->customer_timetable_time_between_dates($selected_customer, $month_sdate, $month_edate, 1, TRUE, TRUE);
    $customer_hours['actual_hours']['fk']['normal'] = $temp_actual_hours_fk['normal_hours'] + $temp_actual_hours_fk['beredskap_hours'];
    $customer_hours['actual_hours']['fk']['oncall'] = $temp_actual_hours_fk['oncall_hours'];
    $temp_actual_hours_kn = $obj_customer->customer_timetable_time_between_dates($selected_customer, $month_sdate, $month_edate, 2, TRUE, TRUE);
    $customer_hours['actual_hours']['kn']['normal'] = $temp_actual_hours_kn['normal_hours'] + $temp_actual_hours_kn['beredskap_hours'];
    $customer_hours['actual_hours']['kn']['oncall'] = $temp_actual_hours_kn['oncall_hours'];
    $temp_actual_hours_tu = $obj_customer->customer_timetable_time_between_dates($selected_customer, $month_sdate, $month_edate, 3, TRUE, TRUE);
    $customer_hours['actual_hours']['tu']['normal'] = $temp_actual_hours_tu['normal_hours'] + $temp_actual_hours_tu['beredskap_hours'];
    $customer_hours['actual_hours']['tu']['oncall'] = $temp_actual_hours_tu['oncall_hours'];
    //echo "<pre>".print_r($customer_hours, 1)."</pre>";
}
$smarty->assign('customer_hours', $customer_hours);


//echo "<pre>month_weeks".print_r($customer_hours, 1)."</pre>"; exit();
/*if($_SESSION['user_role'] != 3){
    $customer_contract_period_hours = array('fk' => array(), 'kn' => array(), 'tu' => array());
    $customer_month_contracts_fk = $obj_customer->customer_contract_month($selected_customer, $selected_Ym, 1, FALSE, TRUE);
    // echo "<pre>".print_r($customer_month_contracts_fk,1)."</pre>";
    if(!empty($customer_month_contracts_fk) && $customer_month_contracts_fk !== FALSE){
        $i = 0;
        foreach($customer_month_contracts_fk as $fk_contract){

            $customer_contract_period_hours['fk'][$i]['period_from']  = $fk_contract['date_from'];
            $customer_contract_period_hours['fk'][$i]['period_to']    = $fk_contract['date_to'];
            $customer_contract_period_hours['fk'][$i]['work_hours']   = $obj_customer->customer_timetable_time_between_dates($selected_customer, $fk_contract['date_from'], $fk_contract['date_to'], 1, FALSE, TRUE);
            $customer_contract_period_hours['fk'][$i]['unmanned_hour'] =  $obj_customer->customer_unmanned_hour_calc($selected_customer, $fk_contract['date_from'], $fk_contract['date_to'], 1);

            $customer_contract_period_hours['fk'][$i]['contract_hours'] = round($fk_contract['hour'], 2);
            $i++;
        }
    }

    $customer_month_contracts_kn = $obj_customer->customer_contract_month($selected_customer, $selected_Ym, 2, FALSE, TRUE);
    if(!empty($customer_month_contracts_kn) && $customer_month_contracts_kn !== FALSE){
        $i = 0;
        foreach($customer_month_contracts_kn as $kn_contract){
            $customer_contract_period_hours['kn'][$i]['period_from']  = $kn_contract['date_from'];
            $customer_contract_period_hours['kn'][$i]['period_to']    = $kn_contract['date_to'];
            $customer_contract_period_hours['kn'][$i]['work_hours']   = $obj_customer->customer_timetable_time_between_dates($selected_customer, $kn_contract['date_from'], $kn_contract['date_to'], 2, FALSE, TRUE);
            $customer_contract_period_hours['kn'][$i]['unmanned_hour'] =  $obj_customer->customer_unmanned_hour_calc($selected_customer, $kn_contract['date_from'], $kn_contract['date_to'], 2);
            $customer_contract_period_hours['kn'][$i]['contract_hours'] = round($kn_contract['hour'], 2);
            $i++;
        }
    }
    $customer_month_contracts_tu = $obj_customer->customer_contract_month($selected_customer, $selected_Ym, 3, FALSE, TRUE);
    if(!empty($customer_month_contracts_tu) && $customer_month_contracts_tu !== FALSE){
        $i = 0;
        foreach($customer_month_contracts_tu as $tu_contract){
            $customer_contract_period_hours['tu'][$i]['period_from']  = $tu_contract['date_from'];
            $customer_contract_period_hours['tu'][$i]['period_to']    = $tu_contract['date_to'];
            $customer_contract_period_hours['tu'][$i]['work_hours']   = $obj_customer->customer_timetable_time_between_dates($selected_customer, $tu_contract['date_from'], $tu_contract['date_to'], 3, FALSE, TRUE);
            $customer_contract_period_hours['tu'][$i]['unmanned_hour'] =  $obj_customer->customer_unmanned_hour_calc($selected_customer, $tu_contract['date_from'], $tu_contract['date_to'], 3);
            $customer_contract_period_hours['tu'][$i]['contract_hours'] = round($tu_contract['hour'], 2);
            $i++;
        }
    }
    $contract_exist_flag = ($customer_hours['work']['fk'] != 0 || $customer_hours['work']['kn'] != 0 || $customer_hours['work']['tu'] != 0 || 
                $customer_hours['contract']['fk'] != 0 || $customer_hours['contract']['kn'] != 0 || $customer_hours['contract']['tu'] != 0 ||
                !empty($customer_month_contracts_fk) || !empty($customer_month_contracts_kn) || !empty($customer_month_contracts_tu)
                ? TRUE : FALSE);
    $smarty->assign('customer_contract_period_hours', $customer_contract_period_hours);
    // echo "<pre>".print_r($customer_contract_period_hours,1)."</pre>";
    // exit('fr');
}
else
    $contract_exist_flag = FALSE;

$smarty->assign('contract_exist_flag', $contract_exist_flag);*/
// calculate contract hours endz 

//getting previleges
$smarty->assign('privileges_gd',$obj_employee->get_privileges($_SESSION['user_id'], 1, $selected_customer));
$smarty->assign('privileges_mc', $obj_employee->get_privileges($_SESSION['user_id'], 3));  
$privileges_general = $obj_employee->get_privileges($_SESSION['user_id'], 2, $selected_customer);
$smarty->assign('privileges_general', $privileges_general);



// ------------------- getting customer saved schedules----------- 
if($selected_customer != NULL && ($privileges_general['create_template'] == 1 || $privileges_general['use_template'] == 1)){
    $customer_schedules = $obj_newCustomer->customer_template_list($selected_customer);
//    $customer_schedules = $obj_newCustomer->get_all_customer_templates();
    $smarty->assign('customer_schedules', $customer_schedules);
}
// ------------------- getting customer saved schedules------------ endz----------- 

$smarty->assign('show_right_panel', false);
if(isset($_REQUEST['show_right_panel']) && $_REQUEST['show_right_panel'] && isset($_REQUEST['right_panel']) && $_REQUEST['right_panel'] != ''){
    $smarty->assign('show_right_panel', true);
    $smarty->assign('right_panel', $_REQUEST['right_panel']);   //memory_slots
//    echo "<pre>".print_r($_REQUEST, 1)."</pre>";
}

$righclick_employees_for_goto = $obj_employee->employees_list_for_right_click($selected_customer);
$smarty->assign('righclick_employees_for_goto', $righclick_employees_for_goto);
//echo $selected_year.'-'.$selected_month;
if(date('Y-m') == $selected_year.'-'.str_pad($selected_month,2,'0',STR_PAD_LEFT)){
    $customer_running_tasks = $obj_timetable->get_customer_running_tasks($selected_customer);
    $smarty->assign('customer_running_tasks', $customer_running_tasks);
}
else{
    $smarty->assign('customer_running_tasks', array());
}
//echo "<pre>".print_r($customer_running_tasks, 1)."</pre>";





$smarty->assign('message', $obj_msg->show_message());
$smarty->assign('swap_copied_slot', isset($_SESSION['swap']) ? $_SESSION['swap'] : '');
$smarty->assign('translate_json', json_encode($smarty->translate));
$smarty->assign('company_id', $_SESSION['company_id']);
//echo "<pre>".print_r($_SESSION, 1)."</pre>";
$smarty->display('gdschema_month.tpl');
//$smarty->display('extends:layouts/dashboard.tpl|gdschema_month.tpl');
?>