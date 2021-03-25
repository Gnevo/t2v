<?php
	// DATE  :	26/03/2018
	// AUTHER:  sreerag
	require_once('class/newcustomer.php');
	require_once('class/setup.php');
	require_once('class/customer.php');
	require_once('plugins/message.class.php');
	require_once('plugins/calender.class.php');
	require_once('class/employee.php');
	require_once('class/company.php');
	require_once('class/template.php');

	$smarty        		= new smartySetup(array("gdschema.xml", "month.xml","messages.xml",'user.xml', 'button.xml', 'tooltip.xml', 'contract.xml', 'reports.xml'),FALSE);
	$new_customer 		= new newcustomer();
	$obj_customer   	= new customer();
	$obj_msg        	= new message();
	$obj_calender   	= new calender();
	$obj_employee   	= new employee();
	$obj_company  		= new company();
	$obj_tmp			= new template();
	
	$schedule_id 		= trim($_GET['id']);
	$customer 			= trim($_GET['customer']);
	$year 				= trim($_GET['year']);
	$current_month     	= trim($_GET['month']);
	$template_name 		= $new_customer->get_template_main_details($schedule_id)[0]['temp_name'];
	$smarty->assign('template_name',$template_name);
	$smarty->assign('privileges_gd',$obj_employee->get_privileges($_SESSION['user_id'], 1, $selected_customer));
	$smarty->assign('privileges_mc', $obj_employee->get_privileges($_SESSION['user_id'], 3));  
	$privileges_general = $obj_employee->get_privileges($_SESSION['user_id'], 2, $customer);
	$smarty->assign('privileges_general', $privileges_general);
	$smarty->assign('flag_cust_access', $obj_customer->is_customer_accessible($customer) ? 1 : 1);
	$months = $obj_calender->get_months();
	$month_label = $months[((int) $current_month - 1)]['month'];
	
	$smarty->assign('month_label', $month_label);
	$smarty->assign('weeks', $obj_calender->get_weeks());
	$smarty->assign('year', $year);
	$smarty->assign('today_year', date('Y'));
	$smarty->assign('today_month', date('m'));
	$smarty->assign('today_date', date('Y-m-d'));
	$smarty->assign('schedule_id', $schedule_id);
	$smarty->assign('customer', $customer);
	$smarty->assign('year', $year);
	$smarty->assign('month', $current_month);
	$smarty->assign('login_user',$_SESSION['user_id']);
	$smarty->assign('no_of_weeks',52);

	$strtotime_prv_year_month = strtotime($year .'-'. $current_month . '-01' . ' -1 month');
	$strtotime_next_year_month = strtotime($year .'-'. $current_month . '-01' . ' +1 month');
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

	$month_weeks = $obj_calender->calender_month($year, $current_month, 01); 
	// echo "<pre>".print_r($month_weeks)."</pre>"; exit();
	$customer_schedules_slots = $new_customer->getTemplateSlots($schedule_id);
	$templates_real_customer  = $customer_schedules_slots[0]['template_customer'];
	$customer_name            = $customer_schedules_slots[0]['cust_name'];
	// echo "<pre>".print_r($customer_schedules_slots,1)."</pre>"; exit();
	$month_sdate = date('Y-m-d', strtotime($year .'-'. $current_month . '-01'));
	$month_edate = date('Y-m-t', strtotime($year .'-'. $current_month . '-01'));
	$have_slot_in_months = array();
	$selected_month_day_slots = array();
	$selected_month_slots = $obj_tmp->customer_slots_btwn_dates($customer, $month_sdate, $month_edate,$schedule_id);

/*if(!empty($customer_schedules_slots)){
    
    //grouping as per day slots
    $templates_real_customer = $customer_schedules_slots[0]['template_customer'];
   	$customer_name			 = $customer_schedules_slots[0]['cust_name'];
    $is_different_customer_for_template = ($customer != $templates_real_customer ? TRUE : FALSE);
    
    $template_start_day_number = date('N', strtotime($template_start_date));
    //if first day of template slot > applying  date day => applying date automatically change to first day of template slot
    if($template_start_day_number < date('N', strtotime($customer_schedules_slots[0]['date']))){
        $first_schedule_slot_date_day_name = date('l', strtotime($customer_schedules_slots[0]['date']));
        $template_start_date = date('Y-m-d', strtotime("next ".$first_schedule_slot_date_day_name." ". $template_start_date));
        $template_start_day_number = date('N', strtotime($template_start_date));
    }
    
    $temp_start_date = $template_start_date;
    $selectedMonthYM = date('Y-m', strtotime($year .'-'. $current_month . '-01' )); // old method.
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
            foreach ($customer_schedules_slots as $slot_key => $slot){
                $slot['is_from_schedule'] = TRUE;
        		$selected_month_day_slots[$slot['date']][] = $slot;
            }

            $temp_start_date = date('Y-m-d', strtotime("next ".$first_schedule_slot_date_day_name." ". $temp_start_date));
            $initial_round = FALSE;
        
    }
}*/
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
    /*foreach ($selected_month_slots as $key => $slot) {
        if($slot['status'] == 2){ //getting leave slots only
            $temp_leave_data = $obj_employee->get_leave_details_byTimeTable_data($slot['employee'], $slot['date'], $slot['time_from'], $slot['time_to']);
            $selected_month_slots[$key]['leave_data'] = $temp_leave_data[0];
            $selected_month_slots[$key]['leave_data']['leave_name'] = $smarty->leave_type[$temp_leave_data[0]['type']];
        
            $related_slot = $obj_employee->check_relations_in_timetable_for_leave($slot['id']);
            if(!empty($related_slot))
                $selected_month_slots[$key]['leave_data']['is_exist_relation'] = 1;
            else
                $selected_month_slots[$key]['leave_data']['is_exist_relation'] = 0;
        }
    }*/
    
    //grouping as per day slots
    foreach ($selected_month_slots as $slot)
        $selected_month_day_slots[$slot['date']][] = $slot;
}

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
                // ECHO $selected_month_day_slots[$week_day['date']]; exit();
                if(isset($selected_month_day_slots) && !empty($selected_month_day_slots)){
                    $month_weeks[$wkey]['days'][$dkey]['slots'] =  $selected_month_day_slots[$week_day['date']];
                	// exit('dfd');
                }
                else{
                    $month_weeks[$wkey]['days'][$dkey]['slots'] = array();
                }
            }
        }
    }
}
	// echo "<pre>".print_r($selected_month_day_slots)."</pre>";
	// echo "<pre>".print_r($month_weeks)."</pre>";
	// echo "<pre>".print_r($customer_schedules_slots,1)."</pre>";exit();
	// echo $template_start_day_number;
	$smarty->assign('customer_name',$customer_name);
	$smarty->assign('customer_id',$templates_real_customer);
	$smarty->assign('month_weeks', $month_weeks);
	$smarty->assign('message', $obj_msg->show_message());
	$smarty->display('gdschema_month_apply_update_schedule.tpl');
	// echo "<pre>".print_r($date_day_name,1)."</pre>";
	// exit();
	

?>