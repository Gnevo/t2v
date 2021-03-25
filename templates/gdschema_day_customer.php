<?php
// ini_set('display_errors', true);
// ini_set('xdebug.var_display_max_depth', 10);
// error_reporting(E_ALL ^ E_NOTICE);
require_once ('class/setup.php');
require_once ('class/customer.php');
require_once ('class/employee.php');
require_once ('class/employee_ext.php');
require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
require_once ('class/company.php');
$smarty         = new smartySetup(array("gdschema.xml", "month.xml","messages.xml",'user.xml', 'button.xml', 'tooltip.xml', 'contract.xml', 'reports.xml', 'mail.xml'));
// $smarty         = new smartySetup(array("common/month.xml","messages.xml",'common/button.xml', 'slot/gdschema.xml', 'slot/gdschema_view.xml'));
//$dona = new dona();
$obj_employee = new employee();
$obj_emp_ext = new employee_ext();
$customer = new customer();
$obj_date = new datecalc();
$msg = new message();
$obj_company   = new company();
//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));
$smarty->assign('message', $msg->show_message()); //messages of actions
if(isset($_SESSION['date_for_selection']))
	$date = $_SESSION['date_for_selection'];
else
	$date = date('Y-m-d');
$year_week = date('o|W', strtotime($date));
$week_position = 1; //3;
if(isset($_REQUEST['date'])){
	$date = $_REQUEST['date'];
	$year_week = date('o|W', strtotime($_REQUEST['date']));
}
$selected_customer = trim($_REQUEST['customer']);
$smarty->assign('selected_customer', $selected_customer);

$_SESSION['date_for_selection'] = $date;
//if(isset($_REQUEST['year_week'])) $year_week = $_REQUEST['year_week'];

$prev_week_day = date('Y-m-d', strtotime('monday last week', strtotime($date)));
$next_week_day = date('Y-m-d', strtotime('next monday', strtotime($date)));
$smarty->assign('alloc_prev_week_day', $prev_week_day);
$smarty->assign('alloc_next_week_day', $next_week_day);

//getting previleges
$privileges_gd = $obj_employee->get_privileges($_SESSION['user_id'], 1);
$smarty->assign('privileges_gd', $privileges_gd);
$privileges_general = $obj_employee->get_privileges($_SESSION['user_id'], 2);
$smarty->assign('privileges_general', $privileges_general);
$smarty->assign('privileges_mc', $obj_employee->get_privileges($_SESSION['user_id'], 3)); 

$search_customers = $customer->customers_list_for_employee_report();
$smarty->assign('search_customers', $search_customers);

$righclick_employees_for_goto = $obj_employee->employees_list_for_right_click($selected_customer);
$smarty->assign('righclick_employees_for_goto', $righclick_employees_for_goto);
$accessible_employee_ids = array();
if(!empty($righclick_employees_for_goto)){
	foreach($righclick_employees_for_goto as $te)
		$accessible_employee_ids[] = $te['username'];
}

$team_employees = $team_employee_ids = array();
if($selected_customer != ''){
	$team_employees = $obj_employee->get_team_employees_of_customer($selected_customer);
	if(!empty($team_employees)){
		foreach($team_employees as $key => $te)
			// if(in_array($te['username'], $accessible_employee_ids))
				$team_employee_ids[] = $te['username'];
			$team_employees[$key]['accessibility'] = in_array($te['username'], $accessible_employee_ids) ? TRUE : FALSE;
	}
}

$smarty->assign('team_employees', $team_employees);
// echo '<pre>'.print_r($team_employees, 1).'</pre>'; //exit();

$employee_day_slots = $obj_emp_ext->get_customer_day_slots($date, $selected_customer, $team_employee_ids);
// echo 'employee_day_slots<pre>'.print_r($employee_day_slots, 1).'</pre>'; exit();
$emp_keys_have_slots = array_keys($employee_day_slots);
$employee_have_no_slots = $obj_emp_ext->get_all_customer_emps_who_have_no_slots($date, $team_employee_ids, $emp_keys_have_slots);
if(!empty($employee_have_no_slots)){
	// echo 'employee_day_slots<pre>'.print_r($employee_day_slots, 1).'</pre>';
	$employee_day_slots = array_merge($employee_day_slots, $employee_have_no_slots);
}

// echo 'employee_day_slots<pre>'.print_r($employee_day_slots, 1).'</pre>';  
// exit();

//sort-out based on timeline 'from-time' digit
if(isset($_REQUEST['sort_by']) && in_array(trim($_REQUEST['sort_by']), array('CUST', 'EMP', 'TIME'))){
	//by default it's sorted by EMP
	if(trim($_REQUEST['sort_by']) == 'TIME'){
		$sorted_employee_day_slots = array();
		if(!empty($employee_day_slots)){

			do{
				$min_time_in_iteration = NULL;
				$employee_min_time_in_iteration = NULL;
			    foreach ($employee_day_slots as $emp_key => $emp_slot_datas) {
			    	if(!empty($emp_slot_datas['slots'])){
			    		if($min_time_in_iteration == NULL || $emp_slot_datas['slots'][0]['slot_from'] < $min_time_in_iteration){
			    			$min_time_in_iteration = $emp_slot_datas['slots'][0]['slot_from'];
			    			$employee_min_time_in_iteration = $emp_key;
			    		}
			    	}
			    }

			    if($min_time_in_iteration !== NULL){
			    	$sorted_employee_day_slots[$employee_min_time_in_iteration] = $employee_day_slots[$employee_min_time_in_iteration];
			    	unset($employee_day_slots[$employee_min_time_in_iteration]);
			    }
			} while (!empty($employee_day_slots) && $min_time_in_iteration !== NULL);

		    if(!empty($employee_day_slots)){
		    	$sorted_employee_day_slots = array_merge($sorted_employee_day_slots, $employee_day_slots);
		    }
		    $employee_day_slots = $sorted_employee_day_slots;
		}
	}
}
else if(isset($_REQUEST['filter_time_from']) && trim($_REQUEST['filter_time_from']) != ''){
	$sorted_employee_day_slots = array();
	$sorting_filter_start_time = (int) trim($_REQUEST['filter_time_from']);
	$sorting_filter_end_time = $sorting_filter_start_time + 1;
	if(!empty($employee_day_slots)){
	    //finding leave details only for leave slots & calculate duration of slot to be free @ the end of the day
	    foreach ($employee_day_slots as $emp_key => $emp_slot_datas) {
	    	if(!empty($emp_slot_datas['slots'])){
	    		$time_found = FALSE;
	    		foreach ($emp_slot_datas['slots'] as $key => $slot) {
	    			if((float) $slot['slot_from'] >= $sorting_filter_start_time && (float) $slot['slot_from'] < $sorting_filter_end_time){
	    				$time_found = TRUE;
	    				break;
	    			}
			    }
			    if($time_found){
			    	$sorted_employee_day_slots[$emp_key] = $emp_slot_datas;
			    	unset($employee_day_slots[$emp_key]);
			    }
	    	}
	    }

	    if(!empty($employee_day_slots)){
	    	$sorted_employee_day_slots = array_merge($sorted_employee_day_slots, $employee_day_slots);
	    }
	    $employee_day_slots = $sorted_employee_day_slots;
	}
}
$smarty->assign('filter_time_from', trim($_REQUEST['filter_time_from']));
$smarty->assign('sort_by', trim($_REQUEST['sort_by']));
// echo 'employee_day_slots<pre>'.print_r($employee_day_slots, 1).'</pre>';  
// exit();

// echo '<pre>'.print_r($employee_day_slots, 1).'</pre>'; 
//----------------------------------
if(!empty($employee_day_slots)){

    $leave_slot_ids = array();
    //finding leave details only for leave slots & calculate duration of slot to be free @ the end of the day
    foreach ($employee_day_slots as $emp_key => $emp_slot_datas) {
    	if(!empty($emp_slot_datas['slots'])){
    		$total_slots_count = count($emp_slot_datas['slots']);
    		foreach ($emp_slot_datas['slots'] as $key => $slot) {
    			//finding leave details only for leave slots
		        if($slot['status'] == 2){ //getting leave slots only
            		$leave_slot_ids[] = $slot['id'];
		            $temp_leave_data = $obj_employee->get_leave_details_byTimeTable_data($slot['employee'], $slot['date'], $slot['slot_from'], $slot['slot_to']);
		            $employee_day_slots[$emp_key]['slots'][$key]['leave_data'] = $temp_leave_data[0];
		            $employee_day_slots[$emp_key]['slots'][$key]['leave_data']['leave_name'] = $smarty->leave_type[$temp_leave_data[0]['type']];
		        
		            // $related_slot = $obj_employee->check_relations_in_timetable_for_leave($slot['id']);
		            // if(!empty($related_slot))
		            //     $employee_day_slots[$emp_key]['slots'][$key]['leave_data']['is_exist_relation'] = 1;
		            // else
		            //     $employee_day_slots[$emp_key]['slots'][$key]['leave_data']['is_exist_relation'] = 0;
		        }

		        //calculate duration of slot to be free @ the end of the day
		        if($key+1 == $total_slots_count && $slot['slot_to'] != '24.00' && $slot['slot_to'] != '24'){
					$slot_difference = $obj_employee->time_difference($slot['slot_to'], '24.00', 100);
					$employee_day_slots[$emp_key]['slots'][$key]['day_end_unalloc_duration'] = $slot_difference;
		        }
		    }
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
        foreach ($employee_day_slots as $emp_key => $emp_slot_datas) {
	    	if(!empty($emp_slot_datas['slots'])){
	    		foreach ($emp_slot_datas['slots'] as $key => $slot) {
		            if($slot['status'] == 2){
		                $employee_day_slots[$emp_key]['slots'][$key]['leave_data']['is_exist_relation'] = !empty($indexed_leave_related_slot_details) && isset($indexed_leave_related_slot_details[$slot['id']]) ? 1 : 0;
		            }
	            }
	        }
        }
    }
}
//----------------------------------
// echo '<pre>'.print_r($employee_day_slots, 1).'</pre>';
$smarty->assign('employee_day_slots', $employee_day_slots);
//echo "<pre>".print_r($employee_day_slots,1)."</pre>"; exit();

//---------------get unmanned slots-----------------------------------
$unmanned_day_slots = $obj_emp_ext->get_customer_day_unmanned_slots($date, $selected_customer);
$smarty->assign('unmanned_day_slots', $unmanned_day_slots);
// echo '<pre>'.print_r($unmanned_day_slots, 1).'</pre>'; exit();
//---------------get unmanned slots endz-----------------------------------

/* ------------------- getting company details - for getting contract hour flag---------------------- */
$company_data = $obj_company->get_company_detail($_SESSION['company_id']);
$smarty->assign('company_contract_checking_flag', $company_data['contract_exceed_check']);
$smarty->assign('company_atl_checking_flag', $company_data['atl_check']);
/* ------------------- getting company details - for getting contract hour flag-----------endz----------- */

$customers_list = $obj_employee->customers_list_for_right_click($_SESSION['user_id']);
$smarty->assign('customers', $customers_list, 'customer');
// echo '<pre>'.print_r($customers_list, 1).'</pre>'; exit();
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);// assign sortby firstname or lastname

// $week_numbers = $obj_date->get_weeks($year_week, 5, $week_position);
$week_numbers = $obj_date->get_weeks($year_week, 1, $week_position);
$holidays = $obj_employee->get_holiday_details_by_date($week_numbers[0]['week_days'][0]['date'], $week_numbers[0]['week_days'][6]['date'], true);

//echo '<pre>'.print_r($week_numbers, 1).'</pre>'; exit();
$smarty->assign('week_numbers', $week_numbers);
$smarty->assign('holidays', $holidays);
$smarty->assign('selected_date', $date);
$smarty->assign('selected_week', $year_week);
$smarty->assign('current_year', date('Y', strtotime($date)));
$smarty->assign('current_month', date('m', strtotime($date)));

$smarty->assign('leave_types', $smarty->leave_type);
$smarty->assign('no_of_weeks',52);

$customer_details = $customer->customer_data($selected_customer);
$smarty->assign('customer_details', $customer_details); 

$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('login_user_role', $_SESSION['user_role']);

//echo "<pre>".print_r($obj_employee->get_privileges($_SESSION['user_id'], 3),1)."</pre>"; exit();
// if($_REQUEST['action'] == 1)
	$smarty->display('gdschema_day_customer.tpl');
// else
// 	$smarty->display('extends:layouts/dashboard.tpl|gdschema_day_customer.tpl');
?>