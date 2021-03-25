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
require_once ('class/team.php');
$smarty         = new smartySetup(array("gdschema.xml", "month.xml","messages.xml",'user.xml', 'button.xml', 'tooltip.xml', 'contract.xml', 'reports.xml', 'mail.xml'));
// $smarty         = new smartySetup(array("common/month.xml","messages.xml",'common/button.xml', 'slot/gdschema.xml', 'slot/gdschema_view.xml'));
//$dona = new dona();
$obj_employee = new employee();
$obj_emp_ext = new employee_ext();
$customer = new customer();
$obj_date = new datecalc();
$msg = new message();
$obj_company   = new company();
$obj_team = new team();
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
$selected_employee = trim($_REQUEST['employee']);
$smarty->assign('selected_employee', $selected_employee);

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

$search_employees = $obj_employee->employees_list_for_right_click($selected_employee);
$smarty->assign('search_employees', $search_employees);

$righclick_customers_for_goto = $customer->customer_list();
$smarty->assign('righclick_customers_for_goto', $righclick_customers_for_goto);
$accessible_customer_ids = array();
if(!empty($righclick_customers_for_goto)){
	foreach($righclick_customers_for_goto as $tc)
		$accessible_customer_ids[] = $tc['username'];
}


//employees customers whos was not signed
$non_signed_customers_of_employee = $obj_team->customers_for_employee_team_gdschema_alloc($selected_employee, $date);
$smarty->assign('non_signed_customers_of_employee', $non_signed_customers_of_employee);
// echo '<pre>'.print_r($non_signed_customers_of_employee, 1).'</pre>';
//all customers of this employees (not checking signing)
$all_customers_of_employee = $obj_employee->get_team_customers_of_employee($selected_employee);

$team_customer_ids = array();
if(!empty($all_customers_of_employee)){
	foreach($all_customers_of_employee as $key => $tc){
		// if(in_array($tc['username'], $accessible_customer_ids)) //|| $privileges_gd['not_show_employees'] == 1
			$team_customer_ids[] = $tc['username'];
		$all_customers_of_employee[$key]['accessibility'] = in_array($tc['username'], $accessible_customer_ids) ? TRUE : FALSE;

	}
}

// echo "<pre>".print_r($all_customers_of_employee, 1)."</pre>";
$smarty->assign('all_customers_of_employee', $all_customers_of_employee);

$customer_day_slots = $obj_emp_ext->get_employee_day_slots($date, $selected_employee, $team_customer_ids);
// echo 'customer_day_slots<pre>'.print_r($customer_day_slots, 1).'</pre>'; exit();
$cust_keys_have_slots = array_keys($customer_day_slots);
$customer_have_no_slots = $obj_emp_ext->get_all_employee_custs_who_have_no_slots($date, $team_customer_ids, $cust_keys_have_slots);
if(!empty($customer_have_no_slots)){
	// echo 'customer_day_slots<pre>'.print_r($customer_day_slots, 1).'</pre>';
	$customer_day_slots = array_merge($customer_day_slots, $customer_have_no_slots);
}

// echo 'customer_day_slots<pre>'.print_r($customer_day_slots, 1).'</pre>';  
// exit();

//sort-out based on timeline 'from-time' digit
if(isset($_REQUEST['sort_by']) && in_array(trim($_REQUEST['sort_by']), array('CUST', 'EMP', 'TIME'))){
	//by default it's sorted by EMP
	if(trim($_REQUEST['sort_by']) == 'TIME'){
		$sorted_customer_day_slots = array();
		if(!empty($customer_day_slots)){

			do{
				$min_time_in_iteration = NULL;
				$employee_min_time_in_iteration = NULL;
			    foreach ($customer_day_slots as $cust_key => $cust_slot_datas) {
			    	if(!empty($cust_slot_datas['slots'])){
			    		if($min_time_in_iteration == NULL || $cust_slot_datas['slots'][0]['slot_from'] < $min_time_in_iteration){
			    			$min_time_in_iteration = $cust_slot_datas['slots'][0]['slot_from'];
			    			$employee_min_time_in_iteration = $cust_key;
			    		}
			    	}
			    }

			    if($min_time_in_iteration !== NULL){
			    	$sorted_customer_day_slots[$employee_min_time_in_iteration] = $customer_day_slots[$employee_min_time_in_iteration];
			    	unset($customer_day_slots[$employee_min_time_in_iteration]);
			    }
			} while (!empty($customer_day_slots) && $min_time_in_iteration !== NULL);

		    if(!empty($customer_day_slots)){
		    	$sorted_customer_day_slots = array_merge($sorted_customer_day_slots, $customer_day_slots);
		    }
		    $customer_day_slots = $sorted_customer_day_slots;
		}
	}
}
else if(isset($_REQUEST['filter_time_from']) && trim($_REQUEST['filter_time_from']) != ''){
	$sorted_customer_day_slots = array();
	$sorting_filter_start_time = (int) trim($_REQUEST['filter_time_from']);
	$sorting_filter_end_time = $sorting_filter_start_time + 1;
	if(!empty($customer_day_slots)){
	    //finding leave details only for leave slots & calculate duration of slot to be free @ the end of the day
	    foreach ($customer_day_slots as $cust_key => $cust_slot_datas) {
	    	if(!empty($cust_slot_datas['slots'])){
	    		$time_found = FALSE;
	    		foreach ($cust_slot_datas['slots'] as $key => $slot) {
	    			if((float) $slot['slot_from'] >= $sorting_filter_start_time && (float) $slot['slot_from'] < $sorting_filter_end_time){
	    				$time_found = TRUE;
	    				break;
	    			}
			    }
			    if($time_found){
			    	$sorted_customer_day_slots[$cust_key] = $cust_slot_datas;
			    	unset($customer_day_slots[$cust_key]);
			    }
	    	}
	    }

	    if(!empty($customer_day_slots)){
	    	$sorted_customer_day_slots = array_merge($sorted_customer_day_slots, $customer_day_slots);
	    }
	    $customer_day_slots = $sorted_customer_day_slots;
	}
}
$smarty->assign('filter_time_from', trim($_REQUEST['filter_time_from']));
$smarty->assign('sort_by', trim($_REQUEST['sort_by']));
// echo 'customer_day_slots<pre>'.print_r($customer_day_slots, 1).'</pre>';  
// exit();

// echo '<pre>'.print_r($customer_day_slots, 1).'</pre>'; 
//----------------------------------
if(!empty($customer_day_slots)){
    $leave_slot_ids = array();
    //finding leave details only for leave slots & calculate duration of slot to be free @ the end of the day
    foreach ($customer_day_slots as $cust_key => $cust_slot_datas) {
    	if(!empty($cust_slot_datas['slots'])){
    		$total_slots_count = count($cust_slot_datas['slots']);
    		foreach ($cust_slot_datas['slots'] as $key => $slot) {
    			//finding leave details only for leave slots
		        if($slot['status'] == 2){ //getting leave slots only
            		$leave_slot_ids[] = $slot['id'];
		            $temp_leave_data = $obj_employee->get_leave_details_byTimeTable_data($slot['employee'], $slot['date'], $slot['slot_from'], $slot['slot_to']);
		            $customer_day_slots[$cust_key]['slots'][$key]['leave_data'] = $temp_leave_data[0];
		            $customer_day_slots[$cust_key]['slots'][$key]['leave_data']['leave_name'] = $smarty->leave_type[$temp_leave_data[0]['type']];
		        
		            // $related_slot = $obj_employee->check_relations_in_timetable_for_leave($slot['id']);
		            // if(!empty($related_slot))
		            //     $customer_day_slots[$cust_key]['slots'][$key]['leave_data']['is_exist_relation'] = 1;
		            // else
		            //     $customer_day_slots[$cust_key]['slots'][$key]['leave_data']['is_exist_relation'] = 0;
		        }

		        //calculate duration of slot to be free @ the end of the day
		        if($key+1 == $total_slots_count && $slot['slot_to'] != '24.00' && $slot['slot_to'] != '24'){
					$slot_difference = $obj_employee->time_difference($slot['slot_to'], '24.00', 100);
					$customer_day_slots[$cust_key]['slots'][$key]['day_end_unalloc_duration'] = $slot_difference;
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
        foreach ($customer_day_slots as $cust_key => $cust_slot_datas) {
	    	if(!empty($cust_slot_datas['slots'])){
	    		foreach ($cust_slot_datas['slots'] as $key => $slot) {
		            if($slot['status'] == 2){
		                $customer_day_slots[$cust_key]['slots'][$key]['leave_data']['is_exist_relation'] = !empty($indexed_leave_related_slot_details) && isset($indexed_leave_related_slot_details[$slot['id']]) ? 1 : 0;
		            }
	            }
	        }
        }
    }
}
//----------------------------------
$smarty->assign('customer_day_slots', $customer_day_slots);
// echo "<pre>".print_r($customer_day_slots,1)."</pre>"; exit();

/*if(!empty($customer_day_slots)){
	foreach ($customer_day_slots as $cust_key => $cust_slot_datas) {
		if ($_SESSION['user_role'] != 3 || ($_SESSION['user_role'] == 3 and ($privileges_gd['not_show_employees'] == 0 || ($privileges_gd['not_show_employees'] == 1 && in_array($cust_key, $accessible_customer_ids))))){

		}

	}
}*/

//---------------get unmanned slots-----------------------------------
$unmanned_day_slots = $obj_emp_ext->get_employee_day_unallocated_customer_slots($date, $selected_employee);
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
// echo '<pre>'.print_r($week_numbers, 1).'</pre>'; exit();
$smarty->assign('week_numbers', $week_numbers);
$smarty->assign('holidays', $holidays);
$smarty->assign('selected_date', $date);
$smarty->assign('selected_week', $year_week);
$smarty->assign('current_year', date('Y', strtotime($date)));
$smarty->assign('current_month', date('m', strtotime($date)));

$smarty->assign('leave_types', $smarty->leave_type);
$smarty->assign('no_of_weeks',52);

$employee_details = $obj_employee->employee_data($selected_employee);
$smarty->assign('employee_details', $employee_details);

$smarty->assign('login_user', $_SESSION['user_id']);
$smarty->assign('login_user_role', $_SESSION['user_role']);

//echo "<pre>".print_r($obj_employee->get_privileges($_SESSION['user_id'], 3),1)."</pre>"; exit();
// if($_REQUEST['action'] == 1)
	$smarty->display('gdschema_day_employee.tpl');
// else
// 	$smarty->display('extends:layouts/dashboard.tpl|gdschema_day_employee.tpl');
?>