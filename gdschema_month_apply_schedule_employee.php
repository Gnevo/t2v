<?php
/**
 * @author: Shamsudheen <shamsu@arioninfotech.com>
 * @description : Month view of timeslots
 * @since 2016-04-30
*/
//ini_set('error_reporting', E_ALL);
//ini_set("display_errors", 1);

require_once('class/setup.php');
require_once('class/customer.php');
require_once('plugins/message.class.php');
require_once('plugins/calender.class.php');
require_once('class/employee.php');
require_once('class/timetable.php');
require_once('class/company.php');
require_once ('class/contract.php');
require_once('class/newcustomer.php');
require_once('class/general.php');
//require_once ('plugins/date_calc.class.php');
//require_once ('class/team.php');
$smarty         = new smartySetup(array("gdschema.xml", "month.xml","messages.xml",'user.xml', 'button.xml', 'tooltip.xml', 'contract.xml', 'reports.xml'),FALSE);
$obj_customer   = new customer();
$obj_msg        = new message();
$obj_calender   = new calender();
$obj_timetable  = new timetable();
$obj_employee   = new employee();
$obj_company   = new company();
$obj_newCustomer = new newcustomer();
$obj_general = new general();
$obj_contract = new contract();

//$obj_date = new datecalc();
//$team = new team();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));

$query_string = explode('&', $_SERVER['QUERY_STRING']);
$selected_year = trim($query_string[0]); //trim($_GET['year']);
$selected_month = trim($query_string[1]); //trim($_GET['month']);
$selected_employee = trim($query_string[2]); //trim($_GET['customer']);
//$selected_schedule = trim($query_string[3]); //trim($_GET['schedule']);
//$template_start_date = trim($query_string[4]); 
$template_start_date = $this_month_start_date = date('Y-m-d', strtotime("$selected_year-$selected_month-01")); 
$this_month_end_date = date('Y-m-t', strtotime($this_month_start_date));
//$no_of_times = trim($query_string[5]) != '' ? trim($query_string[5]) : 1;

//var_dump($query_string);

$privileges_general = $obj_employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privileges_general', $privileges_general);

//limit access this module only to admin
if($privileges_general['use_template'] != 1){
    header('Location: '.$smarty->url.'month/gdschema/employee/'.$selected_year.'/'.$selected_month.'/'.$selected_employee.'/');
    exit();
}

$selected_schedule = $employee_last_template_id = $obj_newCustomer->check_exist_employee_template_id($selected_employee);
$smarty->assign('employee_last_template_id', $employee_last_template_id);

if($employee_last_template_id === FALSE){
    $obj_msg->set_message('fail', 'no_template_exists_for_the_employee');
    header('Location: '.$smarty->url.'month/gdschema/employee/'.$selected_year.'/'.$selected_month.'/'.$selected_employee.'/');
    exit();
}

$smarty->assign('flag_emp_access', $obj_employee->is_employee_accessible($selected_employee) ? 1 : 0);
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('login_user_role', $_SESSION['user_role']);
$smarty->assign('selected_employee', $selected_employee);
$smarty->assign('selected_month', $selected_month);
$smarty->assign('selected_year', $selected_year);
$smarty->assign('selected_schedule', $employee_last_template_id);
$smarty->assign('this_month_start_date', $this_month_start_date);
$smarty->assign('this_month_end_date', $this_month_end_date);

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

//get calendar days in selected month
$month_weeks = $obj_calender->calender_month($selected_year, $selected_month, 01);

/* get customer slots starts */
$month_sdate = date('Y-m-d', strtotime($selected_year .'-'. $selected_month . '-01'));
$month_edate = date('Y-m-t', strtotime($selected_year .'-'. $selected_month . '-01'));
$selected_month_slots = $obj_timetable->employee_slots_btwn_dates($selected_employee, $month_sdate, $month_edate);
//echo "<pre>".print_r($selected_month_slots, 1)."</pre>";
$selected_month_day_slots = array();
if(!empty($selected_month_slots)){
    //finding leave details only for leave slots
    foreach ($selected_month_slots as $key => $slot) {
        if($slot['status'] == 2){ //getting leave slots only
            $temp_leave_data = $obj_employee->get_leave_details_byTimeTable_data($slot['employee'], $slot['date'], $slot['time_from'], $slot['time_to']);
            $selected_month_slots[$key]['leave_data'] = $temp_leave_data[0];
            $selected_month_slots[$key]['leave_data']['leave_name'] = $smarty->leave_type[$temp_leave_data[0]['type']];
        }
    }
    
    //grouping as per day slots
    foreach ($selected_month_slots as $slot)
        $selected_month_day_slots[$slot['date']][] = $slot;
}
/* get customer slots endz */


$employee_schedule_main_details = $obj_newCustomer->get_employee_template_main_by_id($employee_last_template_id);
//echo "<pre>".print_r($employee_schedule_main_details, 1)."</pre>";
$week_difference = $obj_general->datediff('ww', $employee_schedule_main_details['from_date'], $this_month_start_date, false);

/* get customer template slots */
$employee_schedules_slots = $obj_newCustomer->getEmployeeTemplateSlots($selected_schedule);
//echo "<pre>".print_r($employee_schedules_slots, 1)."</pre>";


$normal_process_slot_types = array(0,1,2,4,5,6,7,8,10,15);
$oncall_process_slot_types = array(3,9,14);
$normal_template_total_slot_hours = 0;
$oncall_template_total_slot_hours = 0;
//$obj_employee->time_difference($slot['time_from'], $slot['time_to'], 100);
//echo "<pre>".print_r($employee_schedules_slots, 1)."</pre>";
//$template_slots_only_for_view = array();

if (!empty($employee_schedules_slots)) {
    $template_start_day_number  = date('N', strtotime($employee_schedule_main_details['from_date']));
    $template_end_day_number    = date('N', strtotime($employee_schedule_main_details['to_date']));
    $total_no_of_weeks_in_template = $obj_general->datediff('ww', $employee_schedule_main_details['from_date'], $employee_schedule_main_details['to_date'], false) + 1;

    //grouping template slots as per day
    $modified_employee_schedules_slots = array();
    foreach ($employee_schedules_slots as $slot) {
        $modified_employee_schedules_slots[$slot['date']][] = $slot;
    }
//    echo "<pre>".print_r($modified_employee_schedules_slots, 1)."</pre>";

    $templates_real_employee = $employee_schedules_slots[0]['template_employee'];
    $is_different_employee_for_template = ($selected_employee != $templates_real_employee ? TRUE : FALSE);
        
    if (date('Y-m', strtotime($this_month_start_date)) == date('Y-m', strtotime($employee_schedule_main_details['to_date'])) && $week_difference < 0) {
        $new_circulation_start_date = $employee_schedule_main_details['from_date'];
    } 
    else if ($week_difference >= 0) {

        $new_week_to_start_circulation = '';
        $new_week_to_start_date_circulation = '';
        //Need seperate week to start new circulation of template slots
        if ($template_start_day_number <= $template_end_day_number) {
            $total_no_circulation_completed = (int) ($week_difference / $total_no_of_weeks_in_template);
            $total_weeks_to_complete_circulations = $total_no_circulation_completed * $total_no_of_weeks_in_template;
            $new_week_to_start_circulation = date('W', strtotime($employee_schedule_main_details['from_date'] . " +$total_weeks_to_complete_circulations week"));
            $new_circulation_start_date = date('Y-m-d', strtotime($employee_schedule_main_details['from_date'] . " +$total_weeks_to_complete_circulations week"));
        }
        //Share the last week to begin next circulation of template slots
        else {
//        ++$total_no_of_weeks_in_template;
            $total_no_circulation_completed = (int) ($week_difference / $total_no_of_weeks_in_template);

            $total_weeks_to_complete_circulations = $total_no_circulation_completed * $total_no_of_weeks_in_template;
            $new_week_to_start_circulation = date('W', strtotime($employee_schedule_main_details['from_date'] . " +$total_weeks_to_complete_circulations week"));
//        $paste_end_date = date('Y-m-d', strtotime($paste_year . "W" . $paste_week . '7'));
            $new_circulation_start_date = date('Y-m-d', strtotime($employee_schedule_main_details['from_date'] . " +$total_weeks_to_complete_circulations week"));
        }
    }

    if ((date('Y-m', strtotime($this_month_start_date)) == date('Y-m', strtotime($employee_schedule_main_details['to_date'])) && $week_difference < 0) || $week_difference >= 0){
        
        $date_processed = $new_circulation_start_date;
        $corresponding_template_date = $employee_schedule_main_details['from_date'];
        $this_circulation_no = 1;
        while ($date_processed <= $this_month_end_date) {
            if (isset($modified_employee_schedules_slots[$corresponding_template_date]) && $date_processed >= $this_month_start_date) {
                foreach ($modified_employee_schedules_slots[$corresponding_template_date] as $slot_key => $slot) {
                    $slot['is_from_schedule'] = TRUE;
                    $slot['date'] = $date_processed;

                    if ($is_different_employee_for_template) {
                        $slot['customer'] = NULL;
                        $slot['cust_name'] = NULL;
                        $slot['employee'] = $selected_employee;
                        $slot['emp_name'] = $employee_details['first_name'] . ' ' . $employee_details['last_name'];
                        $slot['status'] = 0;
                    }
                    $selected_month_day_slots[$slot['date']][] = $slot;
//                    $template_slots_only_for_view[] = $slot;
                    
                    //calculate template slot hours
                    $temp_hours = $obj_employee->time_difference($slot['time_from'], $slot['time_to'], 100,false);
                    //echo "<br>";
                    if(in_array($slot['type'], $normal_process_slot_types)){
                        $normal_template_total_slot_hours += $temp_hours;
                    }
                    else if(in_array($slot['type'], $oncall_process_slot_types)){
                        $oncall_template_total_slot_hours += $temp_hours;
                    }
                }
            }


            //check next circulation
            if ($corresponding_template_date == $employee_schedule_main_details['to_date']) {
                $corresponding_template_date = $employee_schedule_main_details['from_date'];

                if ($template_start_day_number <= $template_end_day_number) {
                    $tmp_total_weeks_to_completed = $this_circulation_no * $total_no_of_weeks_in_template;
                    $date_processed = date('Y-m-d', strtotime($new_circulation_start_date . " +$tmp_total_weeks_to_completed week"));
                }
                //Share the last week to begin next circulation of template slots
                else {
                    $tmp_total_weeks_to_completed = $this_circulation_no * $total_no_of_weeks_in_template;
                    $date_processed = date('Y-m-d', strtotime($new_circulation_start_date . " +$tmp_total_weeks_to_completed week"));
                }
                $this_circulation_no++;
            } else {
                $corresponding_template_date = date('Y-m-d', strtotime("$corresponding_template_date +1 day"));
                $date_processed = date('Y-m-d', strtotime("$date_processed +1 day"));
            }
        }
        //echo $oncall_template_total_slot_hours;
        //exit();
    }
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
$smarty->assign('month_weeks', $month_weeks);
//echo "<pre>".print_r($selected_month_day_slots, 1)."</pre>";

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

$normal_template_total_slot_hours = round($normal_template_total_slot_hours, 2);
$oncall_template_total_slot_hours = round($oncall_template_total_slot_hours, 2);
$smarty->assign('normal_template_total_slot_hours', $normal_template_total_slot_hours);
$smarty->assign('oncall_template_total_slot_hours', $oncall_template_total_slot_hours);

$normal_difference_og_and_tmpl = round($work_hours['monthly_nomal'] - $normal_template_total_slot_hours, 2);
$oncall_difference_og_and_tmpl = round($work_hours['monthly_oncall'] - $oncall_template_total_slot_hours, 2);
$smarty->assign('normal_difference_og_and_tmpl', $normal_difference_og_and_tmpl);
$smarty->assign('oncall_difference_og_and_tmpl', $oncall_difference_og_and_tmpl);
//echo "N: $normal_difference <br/>O: $oncall_difference";
/* calculate contract hours endz */


$smarty->assign('message', $obj_msg->show_message());
$smarty->display('gdschema_month_apply_schedule_employee.tpl');
?>