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
//require_once('class/timetable.php');
require_once('class/company.php');
require_once('class/newcustomer.php');
//require_once ('plugins/date_calc.class.php');
//require_once ('class/team.php');
$smarty         = new smartySetup(array("gdschema.xml", "month.xml","messages.xml",'user.xml', 'button.xml', 'tooltip.xml', 'contract.xml', 'reports.xml'),FALSE);
$obj_customer   = new customer();
$obj_msg        = new message();
$obj_calender   = new calender();
//$obj_timetable  = new timetable();
$obj_employee   = new employee();
$obj_company   = new company();
$obj_newCustomer = new newcustomer();

//$obj_date = new datecalc();
//$team = new team();

$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));

$query_string = explode('&', $_SERVER['QUERY_STRING']);
$selected_year = trim($query_string[0]); //trim($_GET['year']);
$selected_month = trim($query_string[1]); //trim($_GET['month']);
$selected_customer = trim($query_string[2]); //trim($_GET['customer']);
$selected_schedule = trim($query_string[3]); //trim($_GET['schedule']);
$template_start_date = trim($query_string[4]); 
$no_of_times = trim($query_string[5]) != '' ? trim($query_string[5]) : 1;


$privileges_general = $obj_employee->get_privileges($_SESSION['user_id'], 2, $selected_customer);
$smarty->assign('privileges_general', $privileges_general);

//limit access this module only to admin
if($privileges_general['use_template'] != 1){
    header('Location: '.$smarty->url.'month/gdschema/'.$selected_year.'/'.$selected_month.'/'.$selected_customer.'/');
    exit();
}

$smarty->assign('flag_cust_access', $obj_customer->is_customer_accessible($selected_customer) ? 1 : 0);
$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('login_user_role', $_SESSION['user_role']);
$smarty->assign('selected_customer', $selected_customer);
$smarty->assign('selected_month', $selected_month);
$smarty->assign('selected_year', $selected_year);
$smarty->assign('selected_schedule', $selected_schedule);
$smarty->assign('template_start_date', $template_start_date);
$smarty->assign('no_of_times', $no_of_times);

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
$smarty->assign('customer_details', $customer_details);
    
//$search_customers = $obj_customer->customers_list_for_employee_report(-1);
$search_customers = $obj_customer->customers_list_for_employee_report();
$smarty->assign('search_customers', $search_customers);

//get calendar days in selected month
$month_weeks = $obj_calender->calender_month($selected_year, $selected_month, 01);

/* get customer slots starts */
//$month_sdate = date('Y-m-d', strtotime($selected_year .'-'. $selected_month . '-01'));
//$month_edate = date('Y-m-t', strtotime($selected_year .'-'. $selected_month . '-01'));
//$selected_month_slots = $obj_timetable->customer_slots_btwn_dates($selected_customer, $month_sdate, $month_edate);
$selected_month_day_slots = array();
/*if(!empty($selected_month_slots)){
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
}*/
/* get customer slots endz */

/* get customer template slots */
$customer_schedules_slots = $obj_newCustomer->getTemplateSlots($selected_schedule);
//echo "$selected_schedule<pre>".print_r($customer_schedules_slots, 1)."</pre>";
$have_slot_in_months = array();
if(!empty($customer_schedules_slots)){
    
    //grouping as per day slots
    $templates_real_customer = $customer_schedules_slots[0]['template_customer'];
    $is_different_customer_for_template = ($selected_customer != $templates_real_customer ? TRUE : FALSE);
    
    $template_start_day_number = date('N', strtotime($template_start_date));
    //if first day of template slot > applying  date day => applying date automatically change to first day of template slot
    if($template_start_day_number < date('N', strtotime($customer_schedules_slots[0]['date']))){
        $first_schedule_slot_date_day_name = date('l', strtotime($customer_schedules_slots[0]['date']));
        $template_start_date = date('Y-m-d', strtotime("next ".$first_schedule_slot_date_day_name." ". $template_start_date));
        $template_start_day_number = date('N', strtotime($template_start_date));
    }
    
    $temp_start_date = $template_start_date;
    $selectedMonthYM = date('Y-m', strtotime($selected_year .'-'. $selected_month . '-01' ));
//    find actual start date of slot for keeping day of the slot after template pasting
    $actual_starting_date_follows_day_number = '';
    $first_slot_week = date('W', strtotime($customer_schedules_slots[0]['date']));
    foreach ($customer_schedules_slots as $slot){
//        echo date('N', strtotime($slot['date'])).'<br/>';
        if(date('W', strtotime($slot['date'])) != $first_slot_week){
            $temp_date_day_name = date('l', strtotime($slot['date']));
            $actual_starting_date_follows_day_number = $slot['date'];
            $template_start_date = date('Y-m-d', strtotime("next ".$temp_date_day_name." ". $template_start_date));
            break;
        }
        if(date('N', strtotime($slot['date'])) < $template_start_day_number) continue;
//echo "zz<pre>".print_r($slot, 1)."</pre>";
        $actual_starting_date_follows_day_number = $slot['date'];
        break;
    }
    $temp_start_date = $template_start_date;
    
//    echo $actual_starting_date_follows_day_number;
    
//    $first_schedule_slot_date_day = date('N', strtotime($customer_schedules_slots[0]['date']));
    $first_schedule_slot_date_day_name = date('l', strtotime($customer_schedules_slots[0]['date']));
    
    if($actual_starting_date_follows_day_number != ''){
        $initial_round = TRUE;
        while($no_of_times > 0){
            foreach ($customer_schedules_slots as $slot_key => $slot){
                $slot['is_from_schedule'] = TRUE;
        //        $slot_date_day = date('d', strtotime($slot['date']));
        //        $slot['date'] = date('Y-m-d', strtotime($selected_year .'-'. $selected_month . '-' .$slot_date_day ));
                if($slot['date'] < $actual_starting_date_follows_day_number && $initial_round) continue;

                if(($initial_round && $slot['date'] == $actual_starting_date_follows_day_number) || (!$initial_round && $slot_key == 0)){
                    $slot['date'] = date('Y-m-d', strtotime($temp_start_date));
                } else {
                    $temp_date_difference = (strtotime($customer_schedules_slots[$slot_key]['date']) - strtotime($customer_schedules_slots[$slot_key-1]['date'])) / 86400;    //86400 = 60 * 60 * 24
                    $slot['date'] = date("Y-m-d",(strtotime(date("Y-m-d", strtotime($temp_start_date)) . " +".$temp_date_difference." days")));
                    $temp_start_date = $slot['date'];
                }

                //store month details that have template slot to preview
                $tmp_first_day_of_this_slot = date('Y-m-01', strtotime($slot['date']));
                if(!in_array($tmp_first_day_of_this_slot, $have_slot_in_months)) $have_slot_in_months[] = $tmp_first_day_of_this_slot;

                if(date('Y-m',  strtotime($slot['date'])) != $selectedMonthYM)  continue;   //to avoid storing other month slot values

                if($is_different_customer_for_template){
                    $slot['customer'] = $selected_customer;
                    $slot['cust_name'] = $customer_details['first_name'] . ' ' . $customer_details['last_name'];
                    $slot['employee'] = NULL;
                    $slot['emp_name'] = NULL;
                    $slot['status'] = 0;
                }
                $selected_month_day_slots[$slot['date']][] = $slot;
            }

    //        $temp_start_date = date("Y-m-d",(strtotime($temp_start_date . " +1 days")));
    //        $temp_start_date = date('Y-m-d', strtotime("next Monday ". $temp_start_date));
            $temp_start_date = date('Y-m-d', strtotime("next ".$first_schedule_slot_date_day_name." ". $temp_start_date));
    //        echo $temp_start_date.'<br/>';
            $no_of_times--;
            $initial_round = FALSE;
        }
        
    }
}
/* get customer template slots endz */
//echo "<pre>".print_r($selected_month_day_slots, 1)."</pre>";
$groped_ym_have_slots = array();
if(!empty($have_slot_in_months)){
    foreach($have_slot_in_months as $fdate){
        $exploded_date = explode('-', $fdate);
        $groped_ym_have_slots[$exploded_date[0]][] = $exploded_date[1];
    }
}
//echo "<pre>".print_r($have_slot_in_months, 1)."</pre>";
//echo "<pre>".print_r($groped_ym_have_slots, 1)."</pre>";
$smarty->assign('groped_ym_have_slots', json_encode($groped_ym_have_slots));
//echo json_encode($groped_ym_have_slots);

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

//getting previleges
$smarty->assign('privileges_gd', $obj_employee->get_privileges($_SESSION['user_id'], 1, $selected_customer));


/* ------------------- getting company details - for getting contract hour flag---------------------- */
$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
/* ------------------- getting company details - for getting contract hour flag-----------endz----------- */


/* ------------------- getting customer saved schedules----------- */
if($selected_customer != NULL){
    $customer_schedules = $obj_newCustomer->customer_template_list($selected_customer);
    $smarty->assign('customer_schedules', $customer_schedules);
}
/* ------------------- getting customer saved schedules------------ endz----------- */
$smarty->assign('company_id', $_SESSION['company_id']);
$smarty->assign('message', $obj_msg->show_message());
$smarty->display('gdschema_month_apply_schedule.tpl');
?>