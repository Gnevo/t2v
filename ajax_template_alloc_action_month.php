<?php
	// @auther: Sreerag 
	// date   : 18/05/2018
	// to modify existing slot details : action modify_slot.
                          
	require_once ('class/setup.php');
	require_once ('plugins/message.class.php');
	require_once ('class/dona.php');
	require_once ('class/employee.php');
	require_once ('class/timetable.php');
	require_once ('class/customer.php');
	require_once ('class/general.php');
	require_once ('class/team.php');
	require_once ('class/template.php');

	$obj_smarty     = new smartySetup(array("gdschema.xml", "month.xml","button.xml",'messages.xml'), FALSE);
	$obj_message    = new message();
	$obj_dona       = new dona();
	$obj_employee   = new employee();
	$obj_timetable  = new timetable();
	$obj_tmp		= new template();

	if(isset($_REQUEST['action']) && trim($_REQUEST['action']) == 'get_day_slots'){
		$obj_general        = new general();
   		$obj_return         = new stdClass();
    	$obj_customer       = new customer();
    	$selected_date      = isset($_REQUEST['date']) ? trim($_REQUEST['date']) : '';
    	$selected_customer  = isset($_REQUEST['pCustomer']) ? trim($_REQUEST['pCustomer']) : '';
        $template_id        = isset($_REQUEST['template_id']) ? trim($_REQUEST['template_id']) : '';
    	$selected_day_slots = $obj_tmp->customer_slots_btwn_dates($selected_customer, $selected_date, $selected_date,$template_id);


    	//finding leave details only for leave slots
	    // foreach ($selected_day_slots as $key => $slot) {
	    //     if($slot['status'] == 2){ //getting leave slots only
	    //         $temp_leave_data = $obj_employee->get_leave_details_byTimeTable_data($slot['employee'], $slot['date'], $slot['time_from'], $slot['time_to']);
	    //         $selected_day_slots[$key]['leave_data'] = $temp_leave_data[0];
	    //         $selected_day_slots[$key]['leave_data']['leave_name'] = $obj_smarty->leave_type[$temp_leave_data[0]['type']];
	        
	    //         $related_slot = $obj_employee->check_relations_in_timetable_for_leave($slot['id']);
	    //         if(!empty($related_slot))
	    //             $selected_day_slots[$key]['leave_data']['is_exist_relation'] = 1;
	    //         else
	    //             $selected_day_slots[$key]['leave_data']['is_exist_relation'] = 0;
	    //     }
	    // }
	    $obj_return->selected_date = $selected_date;
	    $obj_return->swap_copied_slot = isset($_SESSION['swap']) ? $_SESSION['swap'] : '';
	    $obj_return->selected_day_slots = $selected_day_slots;
	    $obj_return->login_user_role = $_SESSION['user_role'];
	    $obj_return->login_user = $_SESSION['user_id'];
	    $obj_return->privileges_gd = $obj_employee->get_privileges($_SESSION['user_id'], 1, $selected_customer);

	    $obj_return = $obj_general->traverse_all_elements_set_null_to_empty($obj_return);
	    
	    if(isset($_REQUEST['show_message']) && $_REQUEST['show_message'] == 'true'){
	        $obj_return->message = $obj_message->show_message();
	    }
	    
	    echo json_encode($obj_return);
	    exit();
	}

	else if ($_REQUEST['action'] == 'check_slot_credentials'){
		$obj_return   = new stdClass();
		$obj_customer = new customer();
		$slot_id      = trim($_REQUEST['slot_id']);
		$slot_details = $obj_tmp->customer_employee_slot_details($slot_id);

	    //find tl-flag
	    $tl_flag = FALSE;
	    if($slot_details['customer'] != '' && $slot_details['employee'] != ''){
	        if($obj_employee->check_login_employee_to_access_employee($slot_details['employee']) && $obj_customer->check_login_employee_to_access_customer($slot_details['customer']))
	            $tl_flag = TRUE;
	    }
	    elseif($slot_details['employee'] != '')
	        $tl_flag = $obj_employee->check_login_employee_to_access_employee($slot_details['employee']);
	    elseif($slot_details['customer'] != '')
	        $tl_flag = $obj_customer->check_login_employee_to_access_customer($slot_details['customer']);

	    $obj_return->tl_flag = $tl_flag;
	    $obj_return->swap_button_hide = (isset($_SESSION['swap']) && $slot_id == $_SESSION['swap'] ? 1 : 0);
	    $obj_return->swap_var = isset($_SESSION['swap']) ? $_SESSION['swap'] : '';

	    
	    echo json_encode($obj_return);
	    exit();
	}

	else if ($_REQUEST['action'] == 'modify_slot') {
        $obj_customer   = new customer();
        
        $slot_id        = trim($_REQUEST['slot_id']);
        $slot_tid       = trim($_REQUEST['slot_tid']);
        $slot_date      = trim($_REQUEST['slot_date']);
        $slot_time_from = trim($_REQUEST['slot_timefrom']);
        $slot_time_to   = trim($_REQUEST['slot_time_to']);
        $slot_customer  = trim($_REQUEST['slot_customer']);
        $slot_employee  = trim($_REQUEST['slot_employee']) != '' ? trim($_REQUEST['slot_employee']) : NULL;
        $slot_fkkn      = trim($_REQUEST['slot_fkkn']);
        $slot_comment   = trim($_REQUEST['slot_comment']) != '' ? trim($_REQUEST['slot_comment']) : NULL;
        $slot_type      = trim($_REQUEST['slot_type']);

        $process_flag   = TRUE;

        if($slot_id == ''){
            $process_flag = FALSE;
            $obj_message->set_message('fail', 'invalid_slot');
        } 
        else if($slot_date == ''){
            $process_flag = FALSE;
            $obj_message->set_message('fail', 'please_select_one_date');
        } 
        else if($slot_time_from == '' || $slot_time_to == ''){
            $process_flag = FALSE;
            $obj_message->set_message('fail', 'invalid_time');
        } 
        else if($slot_customer == '' && !isset($_REQUEST['req_from'])){
            $process_flag = FALSE;
            $obj_message->set_message('fail', 'select_a_customer');
        } 
        else if($slot_employee == '' && isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'employee_monthly_view'){
            $process_flag = FALSE;
            $obj_message->set_message('fail', 'select_an_employee');
        } 
        else if($slot_fkkn == ''){
            $process_flag = FALSE;
            $obj_message->set_message('fail', 'select_a_fkkn');
        } 
        else if($slot_type == ''){
            $process_flag = FALSE;
            $obj_message->set_message('fail', 'select_a_slot_type');
        }

        if($process_flag){
            $slot_details = $obj_tmp->customer_employee_slot_details($slot_id);
            
            //to check old slot has already signed or not if employee/customer changed
            // if($slot_details['customer'] != '' && $slot_details['employee'] != '' && ($slot_customer != $slot_details['customer'] || $slot_employee != $slot_details['employee'])){
            //     if($obj_employee->chk_employee_rpt_signed($slot_details['customer'], $slot_details['employee'], $slot_details['date'], TRUE))
            //           $process_flag = FALSE;  
            // }
        }

        if ($process_flag) {
            $slot_time_from  = $obj_dona->time_to_sixty($slot_time_from);
            $slot_time_to    = $obj_dona->time_to_sixty($slot_time_to);
            if($slot_time_to == 0) $slot_time_to = 24;

            //enters next day
            if($slot_time_from >= $slot_time_to){
                $process_params1 = array(
                    'slot_tid'  => $slot_tid,
                    'employee'  => $slot_employee,
                    'customer'  => $slot_customer,
                    'date'      => $slot_date,
                    'time_from' => $slot_time_from,
                    'time_to'   => 24,
                    'type'      => $slot_type,
                    'fkkn'      => $slot_fkkn);
                if (!$obj_tmp->findout_slot_alteration_bug($process_params1, array($slot_id))) {
                    $process_flag = FALSE;
                } 
                else {
                    $process_params2 = array(
                        'slot_tid'  => $slot_tid,
                        'employee'  => $slot_employee,
                        'customer'  => $slot_customer,
                        'date'      => date('Y-m-d', strtotime(date('Y-m-d', strtotime($slot_date)) . ' +1 day')),
                        'time_from' => 0,
                        'time_to'   => $slot_time_to,
                        'type'      => $slot_type,
                        'fkkn'      => $slot_fkkn);
                    if (!$obj_tmp->findout_slot_alteration_bug($process_params2)) {
                        $process_flag = FALSE;
                    }
                    else {
                        $process_params1['comment'] = $process_params2['comment'] = $slot_comment;
                        //edit first day slot
                        $obj_employee->begin_transaction();
                        // $obj_dona->begin_transaction();
                        $obj_tmp->begin_transaction();
                        $process_flag = $obj_tmp->update_slot_details($slot_id, $process_params1);
                        
                        //create new slot in next day
                        if($process_flag){
                            $process_flag = $obj_tmp->customer_employee_slot_add($process_params2['employee'], $process_params2['customer'], $process_params2['date'], $process_params2['time_from'], $process_params2['time_to'], $_SESSION['user_id'], $process_params2['fkkn'], $process_params2['type'], '', $process_params2['comment']);
                        }
                        
                        if(!$process_flag){
                            $obj_employee->rollback_transaction();
                            $obj_tmp->rollback_transaction();
                            $obj_message->set_message('fail', 'slot_editting_failed');
                        }else{
                            $obj_employee->commit_transaction();
                            $obj_message->set_message('success', 'slot_editting_success');
                        }
                    }
                }
            }
            else{
                $process_params = array(
                 'slot_tid'  => $slot_tid,
                'employee'  => $slot_employee,
                'customer'  => $slot_customer,
                'date'      => $slot_date,
                'time_from' => $slot_time_from,
                'time_to'   => $slot_time_to,
                'type'      => $slot_type,
                'fkkn'      => $slot_fkkn);
                if (!$obj_tmp->findout_slot_alteration_bug($process_params, array($slot_id))) {
                    $process_flag = FALSE;
                } 
                else{
                    $process_params['comment'] = $slot_comment;
                    $process_flag = $obj_tmp->update_slot_details($slot_id, $process_params);
                
                    if(!$process_flag)
                        $obj_message->set_message('fail', 'slot_editting_failed');

                    //add other employees to personal meeting. copied block changes should do whenever requried. 
                    /*$slot_type      = trim($_REQUEST['slot_type']);
                    if($process_flag && $slot_type == 10){
                        $personal_meeting_emps = isset($_REQUEST['personal_meeting_emps']) ? trim($_REQUEST['personal_meeting_emps']) : '';
                        $personal_meeting_employees = explode('||', $personal_meeting_emps);
                        
                        //removing proposed slot employee name from personal meeting employees list if exists
                        if (count($personal_meeting_employees) > 0 && $slot_employee != ''){
                            foreach($personal_meeting_employees as $pkey => $pemp){
                                if($pemp == $slot_employee) unset($personal_meeting_employees[$pkey]);
                            }
                            $personal_meeting_employees = array_values($personal_meeting_employees);
                        }
                        
                        if (count($personal_meeting_employees) > 0) {
                            $obj_dona->begin_transaction();
                            $this_customer = ($slot_customer != '' ? $slot_customer : NULL);
                            $customer_available_free_slots = array();
                            foreach ($personal_meeting_employees as $this_emp) {
                                    $exist_slot = array();
                                    $obj_dona->flush();

                                    //just create an empty customer slots if this customer-employee have slot with another slot type
                                    if ($this_customer != NULL && $this_emp != NULL) {
                                        $tmp_exist_slot_with_cust_emp = $obj_employee->get_slots_exists_btwn_time_ranges($slot_date, $slot_time_from, $slot_time_to, $this_emp, $this_customer, array(10));
                                        if (!empty($tmp_exist_slot_with_cust_emp)) {
                                            if (!$obj_dona->customer_employee_slot_add(NULL, $this_customer, $slot_date, (float) $slot_time_from, (float) $slot_time_to, $_SESSION['user_id'], $slot_fkkn, $slot_details['type'])) {
                                                $obj_message->set_message('fail', 'slot_operation_failed');
                                                $process_flag = FALSE;
                                                break;
                                            }
                                        }
                                        if (!$process_flag)
                                            break;
                                    }

                                    /*  this condition is for checks current slot have employee or not,
                                      if yes, get slots which have unallocated employee with specified customer
                                      if no, get slots which have specified employee with specified customer 
                                    $tmp_exist_slot = $obj_employee->get_intersect_slots($slot_date, $slot_time_from, $slot_time_to, $this_emp);

                                    //check if this employee is currently work with another customer
                                    if (!empty($tmp_exist_slot) && $this_customer != NULL) {
                                        foreach ($tmp_exist_slot as $this_tmp_exist_slot) {
                                            if ($this_tmp_exist_slot['customer'] != '' && $this_tmp_exist_slot['customer'] != $this_customer) {
                                                $process_flag = FALSE;
                                                $emp_details = $obj_employee->get_employee_detail($this_emp);
                                                $emp_name = $emp_details['last_name'] . ' ' . $emp_details['first_name'];
                                                $cust_details = $obj_customer->customer_detail($this_tmp_exist_slot['customer']);
                                                $cust_name = $cust_details['last_name'] . ' ' . $cust_details['first_name'];
                                                $obj_message->set_message('fail', 'employee_already_have_a_slot_with_another_customer');
                                                $obj_message->set_message_exact('fail', $emp_name . ' - ' . $cust_name . ' ' . $this_tmp_exist_slot['date'] . ' ' . str_pad($this_tmp_exist_slot['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($this_tmp_exist_slot['time_to'], 5, '0', STR_PAD_LEFT));
                                                break;
                                            }
                                        }
                                        if (!$process_flag)
                                            break;
                                    }

                                    if ($slot_employee == '' && empty($tmp_exist_slot)) {
                                        //this check for preventing db transactional bugs
                                        if (empty($customer_available_free_slots)) {
                                            $exist_slot = $obj_employee->get_intersect_slots($slot_date, $slot_time_from, $slot_time_to, NULL, $this_customer);
                                            $customer_available_free_slots = $exist_slot;
                                            $slot_employee = $this_emp;
                                        } else {
                                            $exist_slot = array();
                                        }
                                    } else {
                                        $exist_slot = $tmp_exist_slot;
                                    }

                                    //check employee is leave or not
                                    $leave_data = $obj_employee->is_employee_leave($this_emp, $slot_date, $slot_time_from, $slot_time_to);
                                    if ($leave_data !== FALSE) {
                                        $process_flag = FALSE;
                                        $emp_details = $obj_employee->get_employee_detail($this_emp);
                                        $emp_name = $emp_details['last_name'] . ' ' . $emp_details['first_name'];
                                        $obj_message->set_message('fail', 'employee_took_a_leave_when_PM_applied');
                                        $obj_message->set_message_exact('fail', $emp_name . ' ' . $leave_data[0]['date'] . ' ' . str_pad($leave_data[0]['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($leave_data[0]['time_to'], 5, '0', STR_PAD_LEFT));
                                        break;
                                    }

                                    if (!empty($exist_slot)) {
                                        //check this employee is available for this slot
                                        $obj_employee->flush();
                                        if ($obj_employee->chk_employee_rpt_signed($this_emp, $this_customer, $slot_date, TRUE)) {   //check already signed
                                            $process_flag = FALSE;
                                            break;
                                        } else {
                                            $obj_employee->flush();
                                            foreach ($exist_slot as $keyindex => $this_exist_slot) {
                                                if ($keyindex > 0) {
                                                    if ($exist_slot[$keyindex]['time_from'] < $exist_slot[$keyindex - 1]['time_to']) {
                                                        $exist_slot[$keyindex]['time_from'] = $exist_slot[$keyindex - 1]['time_to'];
                                                        if ($exist_slot[$keyindex]['time_to'] >= $exist_slot[$keyindex - 1]['time_to']) {
                                                            unset($exist_slot[$keyindex]);
                                                        }
                                                    }
                                                }
                                                $exist_slot = array_values($exist_slot);       //re-arrange array index values
                                            }
                                            foreach ($exist_slot as $keyindex => $this_exist_slot) {
                                                if (!$obj_dona->time_slot_type_update_for_PM($exist_slot, $keyindex, $slot_type, $slot_time_from, $slot_time_to, $this_customer, $this_emp)) {
                                                    $process_flag = FALSE;
                                                    break;
                                                }
                                            }
                                        }
                                    } else {
                                        //else part is for creating new timeslot with new employee and slot credentials
                                        $obj_employee->flush();
                                        $available_user = $obj_employee->get_available_users($this_customer, $slot_time_from, $slot_time_to, $slot_date, $this_emp);
                                        if (!empty($available_user)) {
                                            //create new slot
                                            $obj_dona->flush();
                                            if (!$obj_dona->customer_employee_slot_add($this_emp, $this_customer, $slot_date, (float) $slot_time_from, (float) $slot_time_to, $_SESSION['user_id'], $slot_fkkn, $slot_type)) {
                                                $obj_message->set_message('fail', 'slot_operation_failed');
                                                $process_flag = FALSE;
                                                break;
                                            }
                                        } else {
                                            $process_flag = FALSE;
                                            $emp_details = $obj_employee->get_employee_detail($this_emp);
                                            $emp_name = $emp_details['last_name'] . ' ' . $emp_details['first_name'];
                                            if ($obj_employee->chk_employee_rpt_signed($this_emp, $this_customer, $slot_date)) {   //check already signed
                                                $customer_details = $obj_customer->customer_detail($this_customer);
                                                $cust_name = $customer_details['last_name'] . ' ' . $customer_details['first_name'];
                                                $obj_message->set_message('fail', 'employee_signed_in');
                                                $obj_message->set_message_exact('fail', $emp_name . ' <-> ' . $cust_name . ' => ' . $slot_date);
                                            } else {      //otherwise slot collides
                                                $collided_slots = $obj_employee->get_collide_slots($this_emp, $slot_time_from, $slot_time_to, $slot_date); // for getting exact collide slot values
                                                $obj_message->set_message('fail', 'slot_collide');
                                                $obj_message->set_message_exact('fail', $emp_name . ' ' . $slot_date . ' ' . str_pad($collided_slots[0]['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($collided_slots[0]['time_to'], 5, '0', STR_PAD_LEFT));
                                            }
                                            break;
                                        }
                                    }
                                if (!$process_flag)
                                    break;
                            }
                            
                            if($process_flag)
                                $obj_dona->commit_transaction();
                            else
                                $obj_dona->rollback_transaction ();
                        }
                    }*/
                    if($process_flag)
                        $obj_message->set_message('success', 'slot_editting_success');
                }
            }
        }
        $obj_return = new stdClass();
        $obj_return->transaction = $process_flag;
        // $obj_return->message = $obj_message->show_message();
        echo json_encode($obj_return);
        exit();
    }

    else if($_REQUEST['action'] == 'avail_employees_for_multiple_slot_change'){
         $template_id = $_REQUEST['template_id'];
        $ids = $_REQUEST['ids'];
        $slots = explode("-", $ids);
        $count_slots = count($slots);
        $slot_ids = "";
        for($i=0 ; $i < $count_slots ; $i++){
            if($slots[$i] != "")
                $slot_ids = $slot_ids == "" ? $slots[$i] : $slot_ids.",".$slots[$i];
        }
        
        $page_user = '';
        $source_type = '';
        //call from gdschema month view
        if(trim($_REQUEST['sel_year']) != '' && trim($_REQUEST['sel_month']) != '' && trim($_REQUEST['customer']) != ''){
            $page_user = trim($_REQUEST['customer']);
            $source_type = 3;
        }
        else if(trim($_REQUEST['sel_year']) != '' && trim($_REQUEST['sel_month']) != '' && trim($_REQUEST['employee']) != ''){
            $page_user = trim($_REQUEST['employee']);
            $source_type = 3;
        }
        else if(isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '') { 
            $page_user = trim($_REQUEST['employee']);
            $source_type = 2;
        }else if(isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '') {
            $page_user = trim($_REQUEST['customer']);
            $source_type = 1;
        }
        
        //get accessible employees dippending their role
        $obj_employee->flush();
        $accessible_employees = array();
        if($source_type == 1)
            $tl_role_on_customer = $obj_employee->get_employee_role_on_customer($page_user, $_SESSION['user_id']);
        if($_SESSION['user_role'] == 3 || $tl_role_on_customer == 3){
            $accessible_employees = $obj_employee->get_employee_ALLdetail($_SESSION['user_id']); 
        }else{
            $accessible_employees = $obj_employee->employees_list_for_right_click($page_user);
        }
        //get selected slot details
        $obj_employee->flush();
        $slots_detail = $obj_tmp->customer_employee_multi_slot_details($slot_ids);
        $slots_count = count($slots_detail);
        $slot_customers = array();
        $slot_employees = array();
        $employees_to_add = array();
        // filter unique customers from selected slots
        for($i = 0 ; $i< $slots_count ; $i++){
            if($slots_detail[$i]['customer'] != '' && $slots_detail[$i]['customer'] != NULL){
                if(!in_array($slots_detail[$i]['customer'], $slot_customers))
                    $slot_customers[] = $slots_detail[$i]['customer'];
                    if (!empty($employees_to_add)){
                        $available_users = $obj_tmp->get_available_users_template($slots_detail[$i]['customer'], $slots_detail[$i]['time_from'], $slots_detail[$i]['time_to'], $slots_detail[$i]['date'],$template_id);
                        $employees_to_add = $obj_employee->employee_intersect($available_users, $employees_to_add);
                    }else{
                        $employees_to_add = $obj_tmp->get_available_users_template($slots_detail[$i]['customer'], $slots_detail[$i]['time_from'], $slots_detail[$i]['time_to'], $slots_detail[$i]['date'],$template_id);
                    }
            }else{
               $employees_to_add = $obj_tmp->get_available_users_template($slots_detail[$i]['customer'], $slots_detail[$i]['time_from'], $slots_detail[$i]['time_to'], $slots_detail[$i]['date'],$template_id); 
            }
            if($slots_detail[$i]['employee'] != '' && $slots_detail[$i]['employee'] != NULL){
                if(!in_array($slots_detail[$i]['employee'], $slot_employees))
                    $slot_employees[] = $slots_detail[$i]['employee'];
            }
        }

        //find ordered names
        if(!empty($employees_to_add)){
            foreach($employees_to_add as $key => $common_employee)
                $employees_to_add[$key]['ordered_name'] = isset($_SESSION['company_sort_by']) && $_SESSION['company_sort_by'] == 1 ? $common_employee['name_ff'] : $common_employee['name'];
        }
        
        $obj_return = new stdClass();
        $obj_return->avail_employees = $employees_to_add;
        if(empty($employees_to_add))
            $obj_return->message = $obj_smarty->translate['no_data_available'];
        // echo "<pre>".print_r($employees_to_add,1)."</pre>";
        echo json_encode($obj_return);
        exit();
    }

?>