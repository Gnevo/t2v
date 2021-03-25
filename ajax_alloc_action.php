<?php

/**
 * @Author: Shamsu <shamsu@arioninfotech.com>
 * action page for time slots
 * changing type of the slots to travel,break and oridinary
 * adding time slot by drag and drop
 * removing skills(then it removes the user also)
 * removing employee (also skill if it is associated)
 * removing customer(also skill if it is associated)
 * removing the whole slot
 * adding manual time slot
 * adding skill
 * adding customer
 * adding employee
 */

require_once('class/setup.php');
require_once ('class/dona.php');
require_once ('class/customer.php');
require_once ('class/employee.php');
require_once ('plugins/message.class.php');
//require_once ('class/equipment.php');
//require_once ('plugins/date_calc.class.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml",'messages.xml'), FALSE);
$msg = new message();
$customer = new customer();
$employee = new employee();
$dona = new dona();
//$equipment = new equipment();
//$week_date = new datecalc();
$url = '';
if (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'monthly_view' && $_REQUEST['customer'] != ''){
    $url = $smarty->url . 'month/gdschema/' . $_REQUEST['gd_year'] . '/' . $_REQUEST['gd_month'] . '/' . $_REQUEST['customer'].'/';
}elseif (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'monthly_view_employee' && $_REQUEST['employee'] != ''){
    $url = $smarty->url . 'month/gdschema/employee/' . $_REQUEST['gd_year'] . '/' . $_REQUEST['gd_month'] . '/' . $_REQUEST['employee'].'/';
}else if (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'gd_customer' && $_REQUEST['customer'] != ''){
    $url = $smarty->url . 'customer/gdschema/'.$_REQUEST['week_num'].'/'.$_REQUEST['customer'].'/8/';
}else if (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'gd_employee' && $_REQUEST['employee'] != ''){
    $url = $smarty->url . 'employee/gdschema/'.$_REQUEST['week_num'].'/'.$_REQUEST['employee'].'/8/';
}else if (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'gd_alloc_window' && $_REQUEST['customer'] != ''){
    $url = $smarty->url . 'gdschema_alloc_window.php?customer='.$_REQUEST['customer'].'&date='.$_REQUEST['gd_page_date'];
}else if (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'gd_alloc_window' && $_REQUEST['employee'] != ''){
    $url = $smarty->url . 'gdschema_alloc_window_employee.php?employee=' . $_REQUEST['employee'].'&date='.$_REQUEST['gd_page_date'];
}else if (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'gd_timeline_customer' && $_REQUEST['customer'] != ''){
    $url = $smarty->url . 'gdschema_day_customer.php?customer='.$_REQUEST['customer'].'&date='.$_REQUEST['gd_page_date'].'&action=1';
}else if (isset($_REQUEST['req_from']) && trim($_REQUEST['req_from']) == 'gd_timeline_employee' && $_REQUEST['employee'] != ''){
    $url = $smarty->url . 'gdschema_day_employee.php?employee='.$_REQUEST['employee'].'&date='.$_REQUEST['gd_page_date'].'&action=1';
}else if ($_REQUEST['employee'] != '' && $_REQUEST['customer'] != ''){
    $url = $smarty->url . 'gdschema_alloc_window.php?customer=' . $_REQUEST['customer'] . '&employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
    $url_slots = $smarty->url . 'ajax_gdschema_alloc_slots.php?customer=' . $_REQUEST['customer'] . '&employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
}else if ($_REQUEST['employee'] == '' && $_REQUEST['customer'] != ''){
    $url = $smarty->url . 'gdschema_alloc_window.php?customer=' . $_REQUEST['customer'] . '&date=' . $_REQUEST['date'];
    $url_slots = $smarty->url . 'ajax_gdschema_alloc_slots.php?customer=' . $_REQUEST['customer'] . '&date=' . $_REQUEST['date'];
}else if ($_REQUEST['employee'] != '' && $_REQUEST['customer'] == ''){
    $url = $smarty->url . 'gdschema_alloc_window_employee.php?employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
    $url_slots = $smarty->url . 'ajax_gdschema_alloc_slots.php?employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
}
//changing slot type to travell, break, normal

if ($_REQUEST['action'] == 'type') {//adding type
    //if updating to break and travel types
    $slot_from = $_REQUEST['slot_from'];
    $slot_to = $_REQUEST['slot_to'];
    $proposed_slot_type = $_REQUEST['type'];
    
    $time_from = $dona->time_to_sixty($_REQUEST['time_from']);
    $time_to = $dona->time_to_sixty($_REQUEST['time_to']);
    
    $personal_meeting_employees = array();
    if($proposed_slot_type == 10){
        $personal_meeting_emps = trim($_REQUEST['personal_meeting_emps']);
        $personal_meeting_employees = explode('||', $personal_meeting_emps);
    //        array_pop($personal_meeting_employees);
    }

    if ($time_to == 0)
        $time_to = 24;
    
    //    $obj_db = new db();
    if ($time_from >= $slot_from && $time_from <= $slot_to && $time_to >= $slot_from && $time_to <= $slot_to && $time_to > $time_from) {
        $dona->begin_transaction();
        $operation_output_flag = TRUE;
        if(count($personal_meeting_employees)> 0 && $proposed_slot_type == 10){
            $slot_det = $employee->customer_employee_slot_details($_REQUEST['id']);
            $this_customer = ($slot_det['customer'] != '' ? $slot_det['customer'] : NULL);
            $customer_available_free_slots = array();
            foreach($personal_meeting_employees as $this_emp){
                if($this_emp == $slot_det['employee']){  //check is this current slot?
                    if (!$dona->employee_slot_type_update($_REQUEST['id'], $proposed_slot_type, $time_from, $time_to)){
                        $operation_output_flag = FALSE;
                        break;
                    }
                    
                    if ($employee->chk_employee_rpt_signed($this_emp, $this_customer, $slot_det['date'], TRUE)) {   //check already signed
                        $operation_output_flag = FALSE;
                        break;
                    }
                    
                    //just create an empty customer slots if this customer-employee have slot with another slot type
                    if($this_customer != NULL && $this_emp != NULL){
                        $tmp_exist_slot_with_cust_emp = $employee->get_slots_exists_btwn_time_ranges($slot_det['date'], $time_from, $time_to, $this_emp, $this_customer, array(10));
                        if(!empty($tmp_exist_slot_with_cust_emp)){
                            if (!$dona->customer_employee_slot_add(NULL, $this_customer, $slot_det['date'], (float) $time_from, (float) $time_to, $_SESSION['user_id'], $slot_det['fkkn'], $slot_det['type'])){
                                $msg->set_message('fail', 'slot_operation_failed');
                                $operation_output_flag = FALSE;
                                break;
                            }
                        }
                        if (!$operation_output_flag) break;
                    }
                }
                else{    //check existance of customer unallocated slot with other employees
                    
                    $exist_slot = array();
                    $dona->flush();
                    
                    //just create an empty customer slots if this customer-employee have slot with another slot type
                    if($this_customer != NULL && $this_emp != NULL){
                        $tmp_exist_slot_with_cust_emp = $employee->get_slots_exists_btwn_time_ranges($slot_det['date'], $time_from, $time_to, $this_emp, $this_customer, array(10));
                        if(!empty($tmp_exist_slot_with_cust_emp)){
                            /*foreach($tmp_exist_slot_with_cust_emp as $this_tmp_exist_slot){
                                if (!$dona->customer_employee_slot_add(NULL, $this_customer, $this_tmp_exist_slot['date'], (float) $this_tmp_exist_slot['time_from'], (float) $this_tmp_exist_slot['time_to'], $_SESSION['user_id'], $this_tmp_exist_slot['fkkn'], $this_tmp_exist_slot['type'])){
                                    $msg->set_message('fail', 'slot_operation_failed');
                                    $operation_output_flag = FALSE;
                                    break;
                                }
                            }*/
                            if (!$dona->customer_employee_slot_add(NULL, $this_customer, $slot_det['date'], (float) $time_from, (float) $time_to, $_SESSION['user_id'], $slot_det['fkkn'], $slot_det['type'])){
                                $msg->set_message('fail', 'slot_operation_failed');
                                $operation_output_flag = FALSE;
                                break;
                            }
                        }
                        if (!$operation_output_flag) break;
                    }
                    
                    /*  this condition is for checks current slot have employee or not,
                        if yes, get slots which have unallocated employee with specified customer
                        if no, get slots which have specified employee with specified customer  */
                    $tmp_exist_slot = $employee->get_intersect_slots($slot_det['date'], $time_from, $time_to, $this_emp);
                    
                    //check if this employee is currently work with another customer
                    if(!empty($tmp_exist_slot) && $this_customer != NULL){
                        foreach($tmp_exist_slot as $this_tmp_exist_slot){
                                if($this_tmp_exist_slot['customer'] != '' && $this_tmp_exist_slot['customer'] != $this_customer){
                                    $operation_output_flag = FALSE;
                                    $emp_details = $employee->get_employee_detail($this_emp);
                                    $emp_name = $emp_details['last_name']. ' '. $emp_details['first_name'];
                                    $cust_details = $customer->customer_detail($this_tmp_exist_slot['customer']);
                                    $cust_name = $cust_details['last_name'] . ' ' . $cust_details['first_name'];
                                    $msg->set_message('fail', 'employee_already_have_a_slot_with_another_customer');
                                    $msg->set_message_exact('fail', $emp_name . ' - ' . $cust_name . ' ' . $this_tmp_exist_slot['date'] . ' ' . str_pad($this_tmp_exist_slot['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($this_tmp_exist_slot['time_to'], 5, '0', STR_PAD_LEFT));
                                    break;
                                }
                        }
                        if (!$operation_output_flag) break;
                    }
                    
                    if($slot_det['employee'] == '' && empty($tmp_exist_slot)){    
                        //                        $exist_slot = $dona->check_slot_exist($time_from, $time_to, $slot_det['date'], NULL, $this_customer);
                        //                        $exist_slot = $employee->get_intersect_slots($slot_det['date'], $time_from, $time_to, NULL);
                        //this check for preventing db transactional bugs
                        if(empty($customer_available_free_slots)){
                            $exist_slot = $employee->get_intersect_slots($slot_det['date'], $time_from, $time_to, NULL, $this_customer);
                            $customer_available_free_slots = $exist_slot;
                            $slot_det['employee '] = $this_emp;
                        } else {
                            //                            $exist_slot = $customer_available_free_slots;
                            $exist_slot = array();
                        }
                        //$exist_slot = array();
                    }else{
                        //                        $exist_slot = $dona->check_slot_exist($time_from, $time_to, $slot_det['date'], $this_emp, $this_customer);
                        //                        $exist_slot = $employee->get_intersect_slots($slot_det['date'], $time_from, $time_to, $this_emp);
                        $exist_slot = $tmp_exist_slot;
                    }
                    
                    //check employee is leave or not
                    $leave_data = $employee->is_employee_leave($this_emp, $slot_det['date'], $time_from, $time_to);
                    if($leave_data !== FALSE){
                        $operation_output_flag = FALSE;
                        $emp_details = $employee->get_employee_detail($this_emp);
                        $emp_name = $emp_details['last_name']. ' '. $emp_details['first_name'];
                        $msg->set_message('fail', 'employee_took_a_leave_when_PM_applied');
                        $msg->set_message_exact('fail', $emp_name . ' ' . $leave_data[0]['date'] . ' ' . str_pad($leave_data[0]['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($leave_data[0]['time_to'], 5, '0', STR_PAD_LEFT));
                        break;
                    }
                    
                    if (!empty($exist_slot)) {
                        //check this employee is available for this slot
                        $employee->flush();
                        if ($employee->chk_employee_rpt_signed($this_emp, $this_customer, $slot_det['date'], TRUE)) {   //check already signed
                            $operation_output_flag = FALSE;
                            break;
                        } else {
                            $employee->flush();
                            foreach($exist_slot as $keyindex => $this_exist_slot){
                                if($keyindex > 0){
                                    if($exist_slot[$keyindex]['time_from'] < $exist_slot[$keyindex - 1]['time_to']){
                                        $exist_slot[$keyindex]['time_from'] = $exist_slot[$keyindex - 1]['time_to'];
                                        if($exist_slot[$keyindex]['time_to'] >= $exist_slot[$keyindex - 1]['time_to']){
                                            unset($exist_slot[$keyindex]);
                                        }
                                    }
                                }
                                $exist_slot  = array_values($exist_slot);       //re-arrange array index values
                            }
                            foreach($exist_slot as $keyindex => $this_exist_slot){
                                if (!$dona->time_slot_type_update_for_PM($exist_slot, $keyindex, $proposed_slot_type, $time_from, $time_to, $this_customer, $this_emp)){
                                    $operation_output_flag = FALSE;
                                    break;
                                }
                            //                                if (!$employee->employee_add_to_slot($this_exist_slot['id'], $this_emp, $_SESSION['user_id'])) {
                            //                                    $msg->set_message('fail', 'slot_operation_failed');
                            //                                    $operation_output_flag = FALSE;
                            //                                    break;
                            //                                }
                            }
                        }
                    } else {
                        //else part is for creating new timeslot with new employee and slot credentials
                        $employee->flush();
                        $available_user = $employee->get_available_users($this_customer, $time_from, $time_to, $slot_det['date'], $this_emp);
                        if (!empty($available_user)) {
                            //create new slot
                            $dona->flush();
                            if (!$dona->customer_employee_slot_add($this_emp, $this_customer, $slot_det['date'], (float) $time_from, (float) $time_to, $_SESSION['user_id'], $slot_det['fkkn'], $proposed_slot_type)){
                                $msg->set_message('fail', 'slot_operation_failed');
                                $operation_output_flag = FALSE;
                                break;
                            }
                        } else {
                            $operation_output_flag = FALSE;
                            $emp_details = $employee->get_employee_detail($this_emp);
                            $emp_name = $emp_details['last_name']. ' '. $emp_details['first_name'];
                            if ($employee->chk_employee_rpt_signed($this_emp, $this_customer, $slot_det['date'])) {   //check already signed
                                $customer_details = $customer->customer_detail($this_customer);
                                $cust_name = $customer_details['last_name']. ' '. $customer_details['first_name'];
                                $msg->set_message('fail', 'employee_signed_in');
                                $msg->set_message_exact('fail', $emp_name .' <-> '.$cust_name .  ' => ' . $slot_det['date']);
                            } else {      //otherwise slot collides
                                $collided_slots = $employee->get_collide_slots($this_emp, $time_from, $time_to, $slot_det['date']); // for getting exact collide slot values
                                $msg->set_message('fail', 'slot_collide');
                                $msg->set_message_exact('fail', $emp_name . ' ' . $slot_det['date'] . ' ' . str_pad($collided_slots[0]['time_from'], 5, '0', STR_PAD_LEFT) . '-' . str_pad($collided_slots[0]['time_to'], 5, '0', STR_PAD_LEFT));
                            }
                            break;
                        }
                    }
                }
                if (!$operation_output_flag)
                    break;
            }
            
            //            $msg = new message();
            //            $msg->set_message_exact('success', "<pre>$this_emp".print_r($____TEST, 1)."</pre>");
            //            $msg->set_message_exact('success', $____TEST);
        }
        else {
            $slot_details = $dona->customer_employee_slot_details($_REQUEST['id']);
            $process_params = array(
                                'employee'      =>  $slot_details['employee'],
                                'customer'      =>  $slot_details['customer'], 
                                'date'          =>  $slot_details['date'], 
                                'type'          =>  $proposed_slot_type, 
                                'time_from'     =>  $time_from, 
                                'time_to'       =>  $time_to); 
            
            if($employee->findout_slot_alteration_bug($process_params, array($_REQUEST['id']))){
                if (!$dona->employee_slot_type_update($_REQUEST['id'], $proposed_slot_type, $time_from, $time_to)) {
                    $operation_output_flag = FALSE;
                }
            }
        }
        
        if($operation_output_flag){
            $dona->commit_transaction();
            //            if(isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
            //                $employee->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
        }else
            $dona->rollback_transaction ();
    } else
        $msg->set_message('fail', 'entered_time_not_within_slot');
}

//adding time slot by drag and drop 
else if ($_REQUEST['action'] == 'drop') {
    //echo "<script>alert(\"".$_REQUEST['time_from']."\")</script>";
    $customer_to_add = $_REQUEST['customer'];
    if ($_SESSION['user_role'] == 4)
        $customer_to_add = $_SESSION['user_id'];
    $this_privileges = $employee->get_privileges($_SESSION['user_id'], 1, $customer_to_add);
    
    $employee_to_add = $_REQUEST['employee'];
    if ($_SESSION['user_role'] == 3) 
        $employee_to_add = ($this_privileges['add_employee'] == 1 ? $_SESSION['user_id'] : '');
    
    if(isset($_REQUEST['from_week']) && isset($_REQUEST['to_week']) && trim($_REQUEST['from_week']) != '' && trim($_REQUEST['to_week']) != ''){
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: drop time slots with schema operation
        */
        $sel_date       = trim($_REQUEST['date']);
        $sel_days       = explode('-', trim($_REQUEST['days']));
        array_pop($sel_days);
        $slot_type = trim($_REQUEST['slotType']);
        $from_week = trim($_REQUEST['from_week']);
        $to_week = trim($_REQUEST['to_week']);
        $from_option = trim($_REQUEST['from_option']);
        
        $__slot_employee = trim($_REQUEST['employee']);
        $__slot_customer = trim($_REQUEST['customer']);
        
        if($__slot_employee == '' || $__slot_employee == NULL){
            $select_employee = trim($_REQUEST['select_employee']);
            if($select_employee == '')
                $__slot_employee = NULL;
            else
               $__slot_employee = $select_employee; 
        }
        $time_from       = $dona->time_to_sixty(trim($_REQUEST['time_from']));
        $time_to         = $dona->time_to_sixty(trim($_REQUEST['time_to']));
        if($time_to == 0) $time_to = 24;
        //-----------------------------------
        $sketch_slot = array(
                        'employee'  => $__slot_employee, 
                        'customer'  => $__slot_customer, 
                        'date'      => $sel_date, 
                        'slot_type' => $slot_type, 
                        'time_from' => $time_from, 
                        'time_to'   => $time_to);
        $result_flag = $employee->schema_drop_time_slots($sketch_slot, $from_week, $to_week, $from_option, $sel_days);
        
        $dont_show_flag = isset($_REQUEST['dnt_show_flag']) && trim($_REQUEST['dnt_show_flag']) == 1 ? TRUE : FALSE;
        if($dont_show_flag && $result_flag){
            $employee->save_customer_employee_general_setting($__slot_customer, $__slot_employee, 'dont_show_slot_operation_flag', 1);
        }
    }
    else {
        /**
         * @author: Shamsudheen <shamsu@arioninfotech.com>
         * for: drop time slots (default)
        */
        
        $time_from       = $dona->time_to_sixty(trim($_REQUEST['time_from']));
        $time_to         = $dona->time_to_sixty(trim($_REQUEST['time_to']));
        if($time_to == 0) $time_to = 24;
            //        if($time_to < $time_from){
            //            
            //        }else{
            $process_params = array(
                'employee'      =>  $employee_to_add,
                'customer'      =>  $customer_to_add, 
                'date'          =>  $_REQUEST['date'], 
                'type'          =>  0, 
                'time_from'     =>  $time_from, 
                'time_to'       =>  $time_to); 

            if($employee->findout_slot_alteration_bug($process_params)){

                $result = $dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $_REQUEST['time_from'], $_REQUEST['time_to'], $_REQUEST['emp_alloc']);
                if (!$result) 
                    $msg->set_message('fail', 'insertion_failed');
                else{
                    $dont_show_flag = isset($_REQUEST['dnt_show_flag']) && trim($_REQUEST['dnt_show_flag']) == 1 ? TRUE : FALSE;
                    if($dont_show_flag){
                        $__slot_employee = isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
                        $__slot_customer = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
                        $employee->save_customer_employee_general_setting($__slot_customer, $__slot_employee, 'dont_show_slot_operation_flag', 1);
                    }
                }
            }
//        }
    }
}
//adding slot by manual entry
else if ($_REQUEST['action'] == 'man_slot_entry') {
    $normal_slot_types = array('0', '1', '2', '4', '5', '6', '7', '8', '10', '11', '12', '15', '16');
    $oncall_slot_types = array('3', '9', '13', '14', '17');
            
    //multiple time slots
    //    $transaction_flag = TRUE;
    
    if ($_REQUEST['sub_action'] == 'multiple_add') {
        $proceed_flag = TRUE;
        $customer_to_add = isset($_REQUEST['selected_customer']) && trim($_REQUEST['selected_customer']) != '' ? trim($_REQUEST['selected_customer']) : NULL;
        if ($_SESSION['user_role'] == 4)  $customer_to_add = $_SESSION['user_id'];
        
        $employee_to_add = isset($_REQUEST['selected_employee']) && trim($_REQUEST['selected_employee']) != '' ? trim($_REQUEST['selected_employee']) : NULL;
        if ($_SESSION['user_role'] == 3)  $employee_to_add = $_SESSION['user_id'];
        
        $selected_date = trim($_REQUEST['selected_date']);
        $slot_periods = array();
        $any_slot_enters_to_next_day = FALSE;
        $split_slots = (isset($_REQUEST['split_slots']) && trim($_REQUEST['split_slots']) == 'yes') ? TRUE : FALSE;
        $convert_to_oncall = isset($_REQUEST['convert_to_oncall']) && $_REQUEST['convert_to_oncall'] == 'yes' ? TRUE : FALSE;
        $flag_employee_slots_collided = FALSE;
        
        if(!empty($_REQUEST['time_slots'])){
            foreach($_REQUEST['time_slots'] as $time_slot){

                $tmp_time_from  = $dona->time_to_sixty(trim($time_slot['time_from']));
                $tmp_time_to    = $dona->time_to_sixty(trim($time_slot['time_to']));
                if($tmp_time_to == 0) $tmp_time_to = 24;

                if($tmp_time_from != false && $tmp_time_to != false){
                    //if the slot enters next day
                    if($tmp_time_from >= $tmp_time_to) $any_slot_enters_to_next_day = TRUE;

                    $slot_periods[] = array( 
                            'time_from' => $tmp_time_from, 
                            'time_to'   => $tmp_time_to, 
                            'customer'  => $customer_to_add != NULL ? $customer_to_add : trim($time_slot['customer']),
                            'employee'  => $employee_to_add != NULL ? $employee_to_add : trim($time_slot['employee']),
                            'comment'   => trim($time_slot['comment']),
                            'fkkn'      => trim($time_slot['fkkn']),
                            'type'      => ((in_array($time_slot['type'], $normal_slot_types) && $convert_to_oncall) ? 3 : trim($time_slot['type'])) 
                        );
                }
            }

            
            //checking employee slots collided together from passed slots
            if(!empty($slot_periods)){
                $count_slots = count($slot_periods);
                for($i = 1 ; $i < $count_slots ; $i++){
                    if ($slot_periods[$i]['employee'] == '') continue;
                    
                    for($j = 0 ; $j < $i ; $j++){
                        
                        if ($slot_periods[$j]['employee'] == '') continue;
                        if ($slot_periods[$j]['employee'] != $slot_periods[$i]['employee']) continue;
                        
                        if(($slot_periods[$j]['time_from'] >= $slot_periods[$i]['time_from'] && $slot_periods[$j]['time_from'] <  $slot_periods[$i]['time_to']) ||
                            ($slot_periods[$j]['time_to'] > $slot_periods[$i]['time_from'] && $slot_periods[$j]['time_to'] <= $slot_periods[$i]['time_to']) ||
                            ($slot_periods[$j]['time_from'] < $slot_periods[$i]['time_from'] && $slot_periods[$j]['time_to'] > $slot_periods[$i]['time_to'])){
                                $flag_employee_slots_collided = TRUE;
                                break;
                        }
                    }
                    if($flag_employee_slots_collided) break;
                }
            }
        }
        
        if($selected_date == '')
            $msg->set_message('fail', 'invalid_date');
        else if(empty($slot_periods))
            $msg->set_message('fail', 'invalid_time');
        else if($flag_employee_slots_collided)
            $msg->set_message('fail', 'employee_slots_collided_within_entered_slots');
        else {
                
            if(isset($_REQUEST['from_week']) && isset($_REQUEST['to_week']) && trim($_REQUEST['from_week']) != '' && trim($_REQUEST['to_week']) != ''){
                /**
                 * @author: Shamsudheen <shamsu@arioninfotech.com>
                 * for: enter time slot manually with schema operation
                */
                $sel_date       = $selected_date;
                $sel_days       = explode('-', trim($_REQUEST['days']));
                $from_week      = trim($_REQUEST['from_week']);
                $to_week        = trim($_REQUEST['to_week']);
                $from_option    = trim($_REQUEST['from_option']);

                $dont_show_flag = isset($_REQUEST['dnt_show_flag']) && trim($_REQUEST['dnt_show_flag']) == 1 ? TRUE : FALSE;
                //echo "<pre>".print_r($slot_periods,1)."</pre>";exit();
                $proceed_flag = $result_flag = $employee->schema_manual_entry_time_slots_multiAdd($selected_date, $slot_periods, $from_week, $to_week, $from_option, $sel_days, $_REQUEST['saveTimeslot'], $dont_show_flag, $convert_to_oncall, $split_slots);
               // exit();
            } 
            
            else {
                $net_process_flag = FALSE;
                $emp_alloc = isset($_REQUEST['emp_alloc']) && trim($_REQUEST['emp_alloc']) != '' ? $_REQUEST['emp_alloc'] : $_SESSION['user_id'];
                $dona->begin_transaction();
                $customer->begin_transaction();
                $employee->begin_transaction();
                $result_flag = TRUE;

                foreach($slot_periods as $slot_period){

                    if($slot_period['customer'] != '' && $slot_period['employee'] != ''){
                        if($employee->chk_employee_rpt_signed($slot_period['employee'], $slot_period['customer'], $selected_date, TRUE) == 1)
                            $proceed_flag = FALSE;
                    }

                    if($proceed_flag){
                        if ($slot_period['time_from'] >= $slot_period['time_to']) { //if the slot enters next day
                            $cur_date = strtotime($selected_date . ' 00:00:00');
                            $next_date = date('Y-m-d', ($cur_date + 24 * 3600));

                            if ($employee->is_valid_slot($slot_period['employee'], $slot_period['time_from'], 24, $selected_date) && $employee->is_valid_slot($slot_period['employee'], 0, $slot_period['time_to'], $next_date)) {
                                if($split_slots && in_array($slot_period['type'], $normal_slot_types)){
                                    $inconv_timings = $employee->get_collided_inconvenients_on_a_day_for_customer($selected_date, $slot_period['customer'], $slot_period['time_from'], 24, 3);
                                    $intervals = array();
                                    if(!empty($inconv_timings)){
                                        $total_count = count($inconv_timings);
                                        $last_time_to = $slot_period['time_from'];
                                        
                                        foreach ($inconv_timings as $key => $inconv_timing) {
                                            $cur_time_from = $cur_time_to = $cur_time_type = '';
                                            if($inconv_timing['time_from'] <= $last_time_to){
                                                if($key != 0 && $inconv_timing['time_from'] != $last_time_to){
                                                    $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $last_time_to);
                                                    $cur_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
                                                    $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
                                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $selected_date);
                                                    $show_msg_exact[] = $selected_date."=>".sprintf('%05.2f',$cur_time_from)."-".sprintf('%05.2f',$cur_time_to);
                                                }
                                                $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $inconv_timing['time_from']);
                                                $cur_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
                                                $cur_time_type = in_array($slot_period['type'], $oncall_slot_types) ? $slot_period['type'] : 3;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $selected_date);
                                                $show_msg_exact[] = $selected_date."=>".sprintf('%05.2f',$cur_time_from)."-".sprintf('%05.2f',$cur_time_to);
                                            }else if($inconv_timing['time_from'] > $last_time_to){
                                                //                                    if($key == 0){
                                                    $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $last_time_to);
                                                    $cur_time_to = $inconv_timing['time_from'];
                                                    $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
                                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $selected_date);
                                                    $show_msg_exact[] = $selected_date."=>".sprintf('%05.2f',$cur_time_from)."-".sprintf('%05.2f',$cur_time_to);
                                                //                                    }

                                                $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $inconv_timing['time_from']);
                                                $cur_time_to = $inconv_timing['time_to'];
                                                $cur_time_type = in_array($slot_period['type'], $oncall_slot_types) ? $slot_period['type'] : 3;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $selected_date);
                                                $show_msg_exact[] = $selected_date."=>".sprintf('%05.2f',$cur_time_from)."-".sprintf('%05.2f',$cur_time_to);
                                            }

                                            $last_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
                                            if($key == $total_count - 1 && $inconv_timing['time_to'] < 24){
                                                $cur_time_from = $last_time_to;
                                                $cur_time_to = 24;
                                                $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $selected_date);
                                            }
                                        }
                                    }else{
                                        $cur_time_from = $slot_period['time_from'];
                                        $cur_time_to = 24;
                                        $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $selected_date);
                                        $show_msg_exact[] = $selected_date."=>".sprintf('%05.2f',$cur_time_from)."-".sprintf('%05.2f',$cur_time_to);
                                    }

                                    $next_day_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($selected_date)) . ' +1 day'));
                                    $inconv_timings_next = $employee->get_collided_inconvenients_on_a_day_for_customer($next_day_date, $slot_period['customer'], 0, $slot_period['time_to'], 3);
                                    if(!empty($inconv_timings_next)){
                                        $total_count = count($inconv_timings_next);
                                        $last_time_to = 0;

                                        foreach ($inconv_timings_next as $key => $inconv_timing) {
                                            $cur_time_from = $cur_time_to = $cur_time_type = '';
                                            if($inconv_timing['time_from'] <= $last_time_to){
                                                if($key != 0 && $inconv_timing['time_from'] != $last_time_to){
                                                    $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $last_time_to);
                                                    $cur_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
                                                    $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
                                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                                    $show_msg_exact[] = $next_day_date."=>".sprintf('%05.2f',$cur_time_from)."-".sprintf('%05.2f',$cur_time_to);
                                                }
                                                $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $inconv_timing['time_from']);
                                                $cur_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
                                                $cur_time_type = in_array($slot_period['type'], $oncall_slot_types) ? $slot_period['type'] : 3;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                                $show_msg_exact[] = $next_day_date."=>".sprintf('%05.2f',$cur_time_from)."-".sprintf('%05.2f',$cur_time_to);                                               
                                            }else if($inconv_timing['time_from'] > $last_time_to){
                                                    //                                    if($key == 0){
                                                    $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $last_time_to);
                                                    $cur_time_to = $inconv_timing['time_from'];
                                                    $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
                                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                                    $show_msg_exact[] = $next_day_date."=>".sprintf('%05.2f',$cur_time_from)."-".sprintf('%05.2f',$cur_time_to);
                                                //                                    }
                                                $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $inconv_timing['time_from']);
                                                $cur_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
                                                $cur_time_type = in_array($slot_period['type'], $oncall_slot_types) ? $slot_period['type'] : 3;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                                $show_msg_exact[] = $next_day_date."=>".sprintf('%05.2f',$cur_time_from)."-".sprintf('%05.2f',$cur_time_to);
                                            }

                                            $last_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
                                            if($key == $total_count - 1 && $inconv_timing['time_to'] < $slot_period['time_to']){
                                                $cur_time_from = $last_time_to;
                                                $cur_time_to = $slot_period['time_to'];
                                                $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                                $show_msg_exact[] = $next_day_date."=>".sprintf('%05.2f',$cur_time_from)."-".sprintf('%05.2f',$cur_time_to);
                                            }
                                        }
                                    }else{
                                        $cur_time_from = 0;
                                        $cur_time_to = $slot_period['time_to'];
                                        $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                        $show_msg_exact[] = $next_day_date."=>".sprintf('%05.2f',$cur_time_from)."-".sprintf('%05.2f',$cur_time_to);
                                    }

                                    if(!empty($intervals)){
                                        foreach ($intervals as $interval) {
                                            if($interval['time_from'] == $interval['time_to']) continue;
                                            if ($dona->customer_employee_slot_add($slot_period['employee'], $slot_period['customer'], $interval['date'], $interval['time_from'], $interval['time_to'], $emp_alloc, $slot_period['fkkn'], $interval['type'], '', $slot_period['comment'])) {
                                                // if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
                                                if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1){ 
                                                //                                                    $customer->add_memory_slot($slot_period['customer'], $tmp_time_from, $tmp_time_to, $interval['type']);
                                                    $customer->add_memory_slot($slot_period['customer'], $tmp_time_from, $tmp_time_to, $interval['type']);
                                                }
                                            }else{
                                                $msg->set_message('fail', 'insertion_failed');
                                                $result_flag = FALSE;
                                                break;
                                            }
                                        }
                                    }
                                } 
                                else {
                                    if ($dona->customer_employee_slot_add($slot_period['employee'], $slot_period['customer'], $selected_date, $slot_period['time_from'], 24, $emp_alloc, $slot_period['fkkn'], $slot_period['type'], '', $slot_period['comment'])) {
                                        //                                        if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
                                        //                                            $customer->add_memory_slot($slot_period['customer'], $slot_period['time_from'], 24, $slot_period['type']);

                                        if ($dona->customer_employee_slot_add($slot_period['employee'], $slot_period['customer'], $next_date, 0, $slot_period['time_to'], $emp_alloc, $slot_period['fkkn'], $slot_period['type'], '', $slot_period['comment'])) {
                                        //                                            if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
                                        //                                                $customer->add_memory_slot($slot_period['customer'], 0, $slot_period['time_to'], $slot_period['type']);

                                            $net_process_flag = TRUE;
                                        } else{
                                            $msg->set_message('fail', 'insertion_failed');
                                            $result_flag = FALSE;
                                            break;
                                        }
                                        
                                        if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1)
                                            $customer->add_memory_slot($slot_period['customer'], $slot_period['time_from'], $slot_period['time_to'], $slot_period['type']);
                                        
                                    } else{
                                        $msg->set_message('fail', 'insertion_failed');
                                        $result_flag = FALSE;
                                        break;
                                    }
                                }
                            } else {
                                $msg->set_message('fail', 'slot_collide');
                                $result_flag = FALSE;
                                break;
                            }
                        }
                        //if the time slot is on same day
                        else {
                            //checking the time is valid
                            $show_msg_exact[] = $selected_date."=>".sprintf('%05.2f',$slot_period['time_from'])."-".sprintf('%05.2f',$slot_period['time_to']);
                            if ($employee->is_valid_slot($slot_period['employee'], $slot_period['time_from'], $slot_period['time_to'], $selected_date)) {
                                if($split_slots && in_array($slot_period['type'], $normal_slot_types)){
                                    $inconv_timings = $employee->get_collided_inconvenients_on_a_day_for_customer($selected_date, $slot_period['customer'], $slot_period['time_from'], $slot_period['time_to'], 3);
                                    //                                    echo "<pre>".print_r($inconv_timings, 1)."</pre>"; exit();
                                    $intervals = array();
                                    if(!empty($inconv_timings)){
                                        $total_count = count($inconv_timings);
                                        $last_time_to = $slot_period['time_from'];
                                        foreach ($inconv_timings as $key => $inconv_timing) {
                                            $cur_time_from = $cur_time_to = $cur_time_type = '';
                                            if($inconv_timing['time_from'] <= $last_time_to){
                                                if($key != 0 && $inconv_timing['time_from'] != $last_time_to){
                                                    $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $last_time_to);
                                                    $cur_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
                                                    $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
                                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                                }
                                                $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $inconv_timing['time_from']);
                                                $cur_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
                                                $cur_time_type = in_array($slot_period['type'], $oncall_slot_types) ? $slot_period['type'] : 3;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                            }else if($inconv_timing['time_from'] > $last_time_to){
                                                    //                                    if($key == 0){
                                                    $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $last_time_to);
                                                    $cur_time_to = $inconv_timing['time_from'];
                                                    $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
                                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                                    //                                    }
                                                $cur_time_from = ($inconv_timing['time_from'] < $slot_period['time_from'] ? $slot_period['time_from'] : $inconv_timing['time_from']);
                                                $cur_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
                                                $cur_time_type = in_array($slot_period['type'], $oncall_slot_types) ? $slot_period['type'] : 3;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                            }

                                            $last_time_to = ($inconv_timing['time_to'] <= $slot_period['time_to'] ? $inconv_timing['time_to'] : $slot_period['time_to']);
                                            if($key == $total_count - 1 && $inconv_timing['time_to'] < $slot_period['time_to']){
                                                $cur_time_from = $last_time_to;
                                                $cur_time_to = $slot_period['time_to'];
                                                $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                            }
                                        }
                                    }else{
                                        $cur_time_from = $slot_period['time_from'];
                                        $cur_time_to = $slot_period['time_to'];
                                        $cur_time_type = in_array($slot_period['type'], $normal_slot_types) ? $slot_period['type'] : 0;
                                        $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                    }

                                    if(!empty($intervals)){
                                        foreach ($intervals as $interval) {
                                            if($interval['time_from'] == $interval['time_to']) continue;
                                            if ($dona->customer_employee_slot_add($slot_period['employee'], $slot_period['customer'], $selected_date, $interval['time_from'], $interval['time_to'], $emp_alloc, $slot_period['fkkn'], $interval['type'], '',$slot_period['comment'])) {
                                                //                                                if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
                                                //                                                    $customer->add_memory_slot($slot_period['customer'], $interval['time_from'], $interval['time_to'], $interval['type']);
                                                if ($slot_period['customer'] != '') 
                                                    $customer->add_memory_slot($slot_period['customer'], $tmp_time_from , $tmp_time_to , $interval['type']);
                                            }else{
                                                $msg->set_message('fail', 'insertion_failed');
                                                $result_flag = FALSE;
                                                break;
                                            }
                                        }
                                    }
                                }else {
                                    if ($dona->customer_employee_slot_add($slot_period['employee'], $slot_period['customer'], $selected_date, $slot_period['time_from'], $slot_period['time_to'], $emp_alloc, $slot_period['fkkn'], $slot_period['type'], '',$slot_period['comment'])) {
                                        //                                        if ($slot_period['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
                                        //                                            $customer->add_memory_slot($slot_period['customer'], $slot_period['time_from'], $slot_period['time_to'], $slot_period['type']);
                                        if ($slot_period['customer'] != '') 
                                            $customer->add_memory_slot($slot_period['customer'], $tmp_time_from, $tmp_time_to, $slot_period['type']);
                                        $net_process_flag = TRUE;
                                    }else{
                                        $msg->set_message('fail', 'insertion_failed');
                                        $result_flag = FALSE;
                                        break;
                                    }
                                }
                            } else {
                                $msg->set_message('fail', 'slot_collide');
                                $result_flag = FALSE;
                                break;
                            }
                        }
                    }

                    if(!$result_flag && $proceed_flag) break;

                        //                $dont_show_flag = isset($_REQUEST['dnt_show_flag']) && trim($_REQUEST['dnt_show_flag']) == 1 ? TRUE : FALSE;
                        //                if($dont_show_flag){
                        //                    $employee->save_customer_employee_general_setting($slot_period['customer'], $slot_period['employee'], 'dont_show_slot_operation_flag', 1);
                        //                }
                }

                if($result_flag && $proceed_flag) {
                    $msg->set_message('success', 'slot_added_success');
                    if(count($show_msg_exact) == 1){
                        $msg->set_message_exact('success', $show_msg_exact[0]);
                    }
                    else{
                        $msg->set_message_exact('success', $smarty->translate['several_slot_added']);
                    }
                    $dona->commit_transaction ();
                    $customer->commit_transaction ();
                    $employee->commit_transaction ();
                    $net_process_flag = TRUE;
                }else {
                    $proceed_flag = FALSE;
                    //                $msg->set_message('fail', 'insertion_failed');
                    $dona->rollback_transaction ();
                    $customer->rollback_transaction ();
                    $employee->rollback_transaction ();
                }
            }
        }
        
        
        if($_REQUEST['stop_if_any_error'] == TRUE && !$proceed_flag){
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            $message = $msg->show_message_exact();
            header($protocol . ' 527 '.utf8_decode($message), true, 527);
        //            header($protocol . ' 527 Internal Server Error - test', true, 527);
        //            header($protocol . ' 418 '.$message, true, 527);
            exit();
        }
        
        if($_REQUEST['reload'] == 'stop'){
            exit();
        }
    }
    
    //single time slot *******************************************************************************
    else {
        $time_from = $dona->time_to_sixty($_REQUEST['time_from']);
        $time_to = $dona->time_to_sixty($_REQUEST['time_to']);
        $comment_textarea = trim($_REQUEST['comment_textarea']);
        $memslot_type = trim($_REQUEST['memslottype']) != '' ? trim($_REQUEST['memslottype']) : 0;
        $slot_fkkn = trim($_REQUEST['slot_fkkn']) != '' ? trim($_REQUEST['slot_fkkn']) : NULL;
        if ($time_to == 0)  $time_to = 24;
        if ($time_from != false && $time_to != false) {
            //$employee_to_add = $_REQUEST['employee'];
            $employee_to_add = trim($_REQUEST['slot_employee']) != '' ? trim($_REQUEST['slot_employee']) : NULL;
            if ($_SESSION['user_role'] == 3)  $employee_to_add = $_SESSION['user_id'];
            //$customer_to_add = $_REQUEST['customer'];
            $customer_to_add = trim($_REQUEST['slot_customer']) != '' ? trim($_REQUEST['slot_customer']) : NULL;
            if ($_SESSION['user_role'] == 4)  $customer_to_add = $_SESSION['user_id'];

            $proceed_flag = TRUE;

            if(isset($_REQUEST['from_week']) && isset($_REQUEST['to_week']) && trim($_REQUEST['from_week']) != '' && trim($_REQUEST['to_week']) != ''){

                /**
                 * @author: Shamsudheen <shamsu@arioninfotech.com>
                 * for: enter time slot manually with schema operation
                */

                $sel_date       = trim($_REQUEST['date']);
                $sel_days       = explode('-', trim($_REQUEST['days']));
                array_pop($sel_days);
                $from_week = trim($_REQUEST['from_week']);
                $to_week = trim($_REQUEST['to_week']);
                $from_option = trim($_REQUEST['from_option']);
                $show_msg_exact = $sel_date;

                //            $__slot_employee = isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
                //            $__slot_customer = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
                $__slot_employee = $employee_to_add;
                $__slot_customer = $customer_to_add;
                $time_from       = trim($_REQUEST['time_from']);
                $time_to         = trim($_REQUEST['time_to']);
                $slot_type       = trim($_REQUEST['slotType']) != '' ? trim($_REQUEST['slotType']) : 0;;

                $dont_show_flag = isset($_REQUEST['dnt_show_flag']) && trim($_REQUEST['dnt_show_flag']) == 1 ? TRUE : FALSE;
                //-----------------------------------
                $sketch_slot = array(
                                'employee'  => $__slot_employee, 
                                'customer'  => $__slot_customer, 
                                'date'      => $sel_date, 
                                'slot_type' => $slot_type, 
                                'time_from' => $time_from, 
                                'time_to'   => $time_to,
                                'fkkn'      => $slot_fkkn,
                                'comment_textarea'   => $comment_textarea,
                                'saveTimeslot'   => $_REQUEST['saveTimeslot']);
                $result_flag = $employee->schema_manual_entry_time_slots($sketch_slot, $from_week, $to_week, $from_option, $sel_days);
                //save dont_show flag on general-settings-table only if it set as 1
                if($dont_show_flag && $result_flag){
                    $employee->save_customer_employee_general_setting($__slot_customer, $__slot_employee, 'dont_show_slot_operation_flag', 1);
                }
                if($result_flag){
                    if(isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
                        $employee->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
                }
            }
            else {
                /**
                 * @author: Shamsudheen <shamsu@arioninfotech.com>
                 * for: enter time slot manually (default)
                */

                $net_process_flag = FALSE;      //for saving atl, if any


                if($employee_to_add != '' && $customer_to_add != ''){
                    if($employee->chk_employee_rpt_signed($employee_to_add, $customer_to_add, $_REQUEST['date'], TRUE) == 1)
                        $proceed_flag = FALSE;
                }

                if($proceed_flag){
                    if ($time_from >= $time_to) { //if the slot enters next day
                        $cur_date = strtotime($_REQUEST['date'] . ' 00:00:00');
                        $next_date = date('Y-m-d', ($cur_date + 24 * 3600));
                        $show_msg_exact = $cur_date.",".$next_date;
                        if ($employee->is_valid_slot($employee_to_add, $time_from, 24, $_REQUEST['date']) && $employee->is_valid_slot($employee_to_add, 0, $time_to, $next_date)) {
                            if(isset($_REQUEST['split']) && trim($_REQUEST['split']) == 'yes'){
                                $result_flag = TRUE;
                                $obj_db = new db();
                                //                        $inconv_timings = $employee->get_inconvenient_on_a_day($_REQUEST['date'],3);
                                //                        $inconv_timings_next = $employee->get_inconvenient_on_a_day(date('Y-m-d', strtotime(date('Y-m-d', strtotime($_REQUEST['date'])) . ' +1 day')),3);
                                $inconv_timings = $employee->get_collided_inconvenients_on_a_day_for_customer($_REQUEST['date'], $customer_to_add, $time_from, 24, 3);
                                $obj_db->begin_transaction();
                                $intervals = array();
                                if(!empty($inconv_timings)){
                                    $total_count = count($inconv_timings);
                                    $last_time_to = $time_from;
                                    foreach ($inconv_timings as $key => $inconv_timing) {
                                        $cur_time_from = $cur_time_to = $cur_time_type = '';
                                        if($inconv_timing['time_from'] <= $last_time_to){
                                            if($key != 0 && $inconv_timing['time_from'] != $last_time_to){
                                                $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $last_time_to);
                                                $cur_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
                                                // cur_time_type = 0;//updated in 2014-06-07
                                                $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $_REQUEST['date']);
                                            }
                                            $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $inconv_timing['time_from']);
                                            $cur_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
                                            //                                        $cur_time_type = 3;//updated in 2014-06-07
                                            $cur_time_type = in_array($memslot_type, $oncall_slot_types) ? $memslot_type : 3;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $_REQUEST['date']);
                                        }else if($inconv_timing['time_from'] > $last_time_to){
                                                //                                    if($key == 0){
                                                $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $last_time_to);
                                                $cur_time_to = $inconv_timing['time_from'];
                                                //                                            $cur_time_type = 0;
                                                $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $_REQUEST['date']);
                                                //                                    }

                                            $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $inconv_timing['time_from']);
                                            $cur_time_to = $inconv_timing['time_to'];
                                                //                                        $cur_time_type = 3;
                                            $cur_time_type = in_array($memslot_type, $oncall_slot_types) ? $memslot_type : 3;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $_REQUEST['date']);
                                        }

                                        $last_time_to = ($inconv_timing['time_to'] <= 24 ? $inconv_timing['time_to'] : 24);
                                        if($key == $total_count - 1 && $inconv_timing['time_to'] < 24){
                                            $cur_time_from = $last_time_to;
                                            $cur_time_to = 24;
                                            //                                        $cur_time_type = 0;
                                            $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $_REQUEST['date']);
                                        }
                                    }
                                }else{
                                    $cur_time_from = $time_from;
                                    $cur_time_to = 24;
                                    //                                $cur_time_type = 0;
                                    $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $_REQUEST['date']);
                                }

                                $next_day_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($_REQUEST['date'])) . ' +1 day'));
                                $inconv_timings_next = $employee->get_collided_inconvenients_on_a_day_for_customer($next_day_date, $customer_to_add, 0, $time_to, 3);
                                if(!empty($inconv_timings_next)){
                                    $total_count = count($inconv_timings_next);
                                    $last_time_to = 0;
                                    foreach ($inconv_timings_next as $key => $inconv_timing) {
                                        $cur_time_from = $cur_time_to = $cur_time_type = '';
                                        if($inconv_timing['time_from'] <= $last_time_to){
                                            if($key != 0 && $inconv_timing['time_from'] != $last_time_to){
                                                $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $last_time_to);
                                                $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
                                            //                                            $cur_time_type = 0;
                                                $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                            }
                                            $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $inconv_timing['time_from']);
                                            $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
                                            //                                        $cur_time_type = 3;
                                            $cur_time_type = in_array($memslot_type, $oncall_slot_types) ? $memslot_type : 3;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                        }else if($inconv_timing['time_from'] > $last_time_to){
        //                                    if($key == 0){
                                                $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $last_time_to);
                                                $cur_time_to = $inconv_timing['time_from'];
                                                //                                            $cur_time_type = 0;
                                                $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                            //                                    }
                                            $cur_time_from = ($inconv_timing['time_from'] < 0 ? 0 : $inconv_timing['time_from']);
                                            $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
                                            //                                        $cur_time_type = 3;
                                            $cur_time_type = in_array($memslot_type, $oncall_slot_types) ? $memslot_type : 3;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                        }

                                        $last_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
                                        if($key == $total_count - 1 && $inconv_timing['time_to'] < $time_to){
                                            $cur_time_from = $last_time_to;
                                            $cur_time_to = $time_to;
                                            //                                        $cur_time_type = 0;
                                            $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                        }
                                    }
                                }else{
                                    $cur_time_from = 0;
                                    $cur_time_to = $time_to;
                                    //                                $cur_time_type = 0;
                                    $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type, 'date' => $next_day_date);
                                }

                                foreach ($intervals as $interval) {
                                    if($interval['time_from'] == $interval['time_to']) continue;
                                    if ($dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $interval['date'], $interval['time_from'], $interval['time_to'], $_REQUEST['emp_alloc'], $slot_fkkn, $interval['type'], '',$comment_textarea)) {
                                        //                                        if ($_REQUEST['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
                                        //                                            $customer->add_memory_slot($customer_to_add, $interval['time_from'], $interval['time_to'], $interval['type']);
                                        if ($_REQUEST['customer'] != '') 
                                            $customer->add_memory_slot($customer_to_add, $tmp_time_from, $tmp_time_to, $interval['type']);
                                    }else{
                                        $result_flag = FALSE;
                                        break;
                                    }
                                }
                                if($result_flag) {
                                    $msg->set_message('success', 'slot_added_success');
                                    $msg->set_message_exact('success', $show_msg_exact);
                                    $obj_db->commit_transaction ();
                                    $net_process_flag = TRUE;
                                }else {
                                    $msg->set_message('fail', 'insertion_failed');
                                    $obj_db->rollback_transaction ();
                                }
                            } else {
                                if ($dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $time_from, 24, $_REQUEST['emp_alloc'], $slot_fkkn,$memslot_type,'',$comment_textarea)) {
                                    if ($_REQUEST['customer'] != '' && $_REQUEST['saveTimeslot'] == 1)
                                    //                                        $customer->add_memory_slot($customer_to_add, $time_from, 24, $memslot_type);

                                    if ($dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $next_date, 0, $time_to, $_REQUEST['emp_alloc'], $slot_fkkn,$memslot_type,'',$comment_textarea)) {
                                        //                                        if ($_REQUEST['customer'] != '' && $_REQUEST['saveTimeslot'] == 1)
                                        //                                            $customer->add_memory_slot($customer_to_add, 0, $time_to, $memslot_type);

                                        $net_process_flag = TRUE;
                                    } else
                                        $msg->set_message('fail', 'insertion_failed');
                                    $customer->add_memory_slot($customer_to_add, $time_from, $time_to, $memslot_type);
                                } else
                                    $msg->set_message('fail', 'insertion_failed');
                            }
                        } else
                            $msg->set_message('fail', 'slot_collide');
                    } else {//if the time slot is on same day
                        //checking the time is valid
                        if ($employee->is_valid_slot($employee_to_add, $time_from, $time_to, $_REQUEST['date'])) {
                            if(isset($_REQUEST['split']) && trim($_REQUEST['split']) == 'yes'){
                                $result_flag = TRUE;
                                $obj_db = new db();
                                //                        $inconv_timings = $employee->get_inconvenient_on_a_day($_REQUEST['date'],3);
                                $inconv_timings = $employee->get_collided_inconvenients_on_a_day_for_customer($_REQUEST['date'], $customer_to_add, $time_from, $time_to, 3);
                                $obj_db->begin_transaction();
                                $intervals = array();
                                if(!empty($inconv_timings)){
                                    $total_count = count($inconv_timings);
                                    $last_time_to = $time_from;
                                    foreach ($inconv_timings as $key => $inconv_timing) {
                                        $cur_time_from = $cur_time_to = $cur_time_type = '';
                                        if($inconv_timing['time_from'] <= $last_time_to){
                                            if($key != 0 && $inconv_timing['time_from'] != $last_time_to){
                                                $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $last_time_to);
                                                $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
                                                //                                            $cur_time_type = 0;
                                                $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                            }
                                            $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $inconv_timing['time_from']);
                                            $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
                                            //                                        $cur_time_type = 3;
                                            $cur_time_type = in_array($memslot_type, $oncall_slot_types) ? $memslot_type : 3;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                        }else if($inconv_timing['time_from'] > $last_time_to){
                                            //                                    if($key == 0){
                                                $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $last_time_to);
                                                $cur_time_to = $inconv_timing['time_from'];
                                            //                                            $cur_time_type = 0;
                                                $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
                                                $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                            //                                    }
                                            $cur_time_from = ($inconv_timing['time_from'] < $time_from ? $time_from : $inconv_timing['time_from']);
                                            $cur_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
                                            //                                        $cur_time_type = 3;
                                            $cur_time_type = in_array($memslot_type, $oncall_slot_types) ? $memslot_type : 3;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                        }

                                        $last_time_to = ($inconv_timing['time_to'] <= $time_to ? $inconv_timing['time_to'] : $time_to);
                                        if($key == $total_count - 1 && $inconv_timing['time_to'] < $time_to){
                                            $cur_time_from = $last_time_to;
                                            $cur_time_to = $time_to;
                                            //                                        $cur_time_type = 0;
                                            $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
                                            $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                        }
                                    }
                                }else{
                                    $cur_time_from = $time_from;
                                    $cur_time_to = $time_to;
                                    //                                $cur_time_type = 0;
                                    $cur_time_type = in_array($memslot_type, $normal_slot_types) ? $memslot_type : 0;
                                    $intervals[] = array('time_from' => $cur_time_from, 'time_to' => $cur_time_to, 'type' => $cur_time_type);
                                }
                                $show_msg_exact = $_REQUEST['date'];
                                //                            echo "<pre>".print_r($intervals, 1)."</pre>"; exit();
                                foreach ($intervals as $interval) {
                                    if($interval['time_from'] == $interval['time_to']) continue;
                                    if ($dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $interval['time_from'], $interval['time_to'], $_REQUEST['emp_alloc'], $slot_fkkn,$interval['type'],'',$comment_textarea)) {
                                    //                                        if ($_REQUEST['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
                                    //                                            $customer->add_memory_slot($customer_to_add, $interval['time_from'], $interval['time_to'], $interval['type']);
                                        if ($_REQUEST['customer'] != '') 
                                            $customer->add_memory_slot($customer_to_add, $tmp_time_from, $tmp_time_to, $interval['type']);
                                    }else{
                                        $result_flag = FALSE;
                                        break;
                                    }
                                }
                                if($result_flag) {
                                    $msg->set_message('success', 'slot_added_success');
                                    $msg->set_message_exact('success', $show_msg_exact);
                                    $obj_db->commit_transaction ();
                                    $net_process_flag = TRUE;
                                }else {
                                    $msg->set_message('fail', 'insertion_failed');
                                    $obj_db->rollback_transaction ();
                                }
                            }else {
                                if ($dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $time_from, $time_to, $_REQUEST['emp_alloc'], $slot_fkkn,$memslot_type,'',$comment_textarea)) {
                                    //                                    if ($_REQUEST['customer'] != '' && $_REQUEST['saveTimeslot'] == 1) 
                                    //                                        $customer->add_memory_slot($customer_to_add, $time_from, $time_to, $memslot_type);
                                    if ($_REQUEST['customer'] != '') 
                                        $customer->add_memory_slot($customer_to_add, $time_from, $time_to, $memslot_type);
                                    $net_process_flag = TRUE;
                                }else
                                    $msg->set_message('fail', 'insertion_failed');
                            }
                        } else
                            $msg->set_message('fail', 'slot_collide');
                    }

                    $dont_show_flag = isset($_REQUEST['dnt_show_flag']) && trim($_REQUEST['dnt_show_flag']) == 1 ? TRUE : FALSE;
                    if($dont_show_flag){
                        //                    $__slot_employee = isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
                        //                    $__slot_customer = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
                        $employee->save_customer_employee_general_setting($customer_to_add, $employee_to_add, 'dont_show_slot_operation_flag', 1);
                    }
                }
                //                if($net_process_flag && isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
                //                        $employee->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
            }
        } else
            $msg->set_message('fail', 'invalid_time');
    
    }
}

//removing employee (also skill if it is associated)
else if ($_REQUEST['action'] == 'emp_remove') {
    $slot_det = $dona->customer_employee_slot_details($_REQUEST['id']);
    if ($_REQUEST['employee'] != '' && $_REQUEST['customer'] != '') {

        if ($employee->remove_from_slot($_REQUEST['id'], $_REQUEST['emp_alloc'])) {
//             echo'<script>$("#chk_status").val("1");navigatePage(\'' . $url . '\', 1);</script>';
        }
    } else if ($_REQUEST['employee'] == '' || $_REQUEST['customer'] == '') {

        if ($slot_det['customer'] == '') {

            if ($dona->customer_employee_slot_remove($_REQUEST['id'])) {
//                 echo'<script>$("#chk_status").val("1");navigatePage(\'' . $url . '\', 1);</script>';
            }
        } else {
            if ($employee->remove_from_slot($_REQUEST['id'], $_REQUEST['emp_alloc'])) {
                 //echo'<script>$("#chk_status").val("1");navigatePage(\'' . $url . '\', 1)</script>';
                 if ($slot_det['customer'] == '') {
                    if ($dona->customer_employee_skill_remove($_REQUEST['id'], $_REQUEST['emp_alloc'])) {
  //                  echo '<script>navigatePage(\'' . $url . '\', 1)</script>';
                    }
                  } else {
//                  echo '<script>navigatePage(\'' . $url . '\', 1)</script>';
                  } 
            }
        }
    }
}

//removing customer (also skill if it is associated)
else if ($_REQUEST['action'] == 'cust_remove') {
    $slot_det = $customer->customer_employee_slot_details($_REQUEST['id']);
    if ($_REQUEST['employee'] != '' && $_REQUEST['customer'] != '') {

        if ($customer->remove_from_slot($_REQUEST['id'], $_REQUEST['emp_alloc'])) {
//             echo'<script>$("#chk_status").val("1"); navigatePage(\'' . $url . '\', 1);</script>';
        }
    } else if ($_REQUEST['employee'] == '' || $_REQUEST['customer'] == '') {
        if ($slot_det['employee'] == '') {
            if ($dona->customer_employee_slot_remove($_REQUEST['id'])) {
//                 echo'<script>$("#chk_status").val("1"); navigatePage(\'' . $url . '\', 1);</script>';
            }
        } else {
            if ($customer->remove_from_slot($_REQUEST['id'], $_REQUEST['emp_alloc'])) {
//                echo'<script>$("#chk_status").val("1"); navigatePage(\'' . $url . '\', 1);</script>';
                if ($slot_det['employee'] == '') {
                    if ($dona->customer_employee_skill_remove($_REQUEST['id'], $_REQUEST['emp_alloc'])) {
  //                  echo '<script>$("#chk_status").val("1"); navigatePage(\'' . $url . '\', 1);</script>';
                    }
                  } else {
//                  echo '<script>$("#chk_status").val("1"); navigatePage(\'' . $url . '\', 1);</script>';
                  }
            }
        }
    }
}

//removing the whole slot
else if ($_REQUEST['action'] == 'slot_remove') {
    $dona->customer_employee_slot_remove($_REQUEST['id']);
//    echo'<script>$("#chk_status").val("1"); navigatePage(\'' . $url . '\', 1);</script>';
}

//Adding employee
else if ($_REQUEST['action'] == 'add_emp') {
    
    $result_flag = FALSE;
    if ($_SESSION['user_role'] == 3){
        $slot_det = $employee->customer_employee_slot_details($_REQUEST['id']);
        if ($slot_det['customer'] != '' && $slot_det['employee'] == ''){
            
            //$empl_contract_check = $employee->check_employee_contract($slot_det['customer'],$slot_det['time_from'], $slot_det['time_to'], $slot_det['date']);
                $available_users = $employee->get_available_users($slot_det['customer'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['date'], $_SESSION['user_id']);
                if(!empty($available_users)){
                    if($employee->employee_add_to_slot($_REQUEST['id'], $_SESSION['user_id'], $_SESSION['user_id']))
                            $result_flag = TRUE;
                }else{
                    $msg->set_message('fail', 'no_employee_available');
                }
        }
    }else if(isset($_REQUEST['select_emp'])){
        $slot_det = $employee->customer_employee_slot_details($_REQUEST['id']);
        $process_params = array(
                            'employee'      =>  $_REQUEST['select_emp'],
                            'customer'      =>  $slot_det['customer'], 
                            'date'          =>  $slot_det['date'], 
                            'type'          =>  $slot_det['type'], 
                            'time_from'     =>  $slot_det['time_from'], 
                            'time_to'       =>  $slot_det['time_to']); 
        
        if($employee->findout_slot_alteration_bug($process_params)){
            if($employee->employee_add_to_slot($_REQUEST['id'], $_REQUEST['select_emp'], $_SESSION['user_id']))
                    $result_flag = TRUE;
        }
    }
    else{
        $slot_det = $employee->customer_employee_slot_details($_REQUEST['id']);
        if ($slot_det['customer'] != '' && $slot_det['employee'] == ''){
                $available_users = $employee->get_available_users($slot_det['customer'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['date']);
                if(count($available_users) == 1){
                    if($employee->employee_add_to_slot($_REQUEST['id'], $available_users[0]['username'], $_SESSION['user_id']))
                            $result_flag = TRUE;
                }elseif(empty($available_users)){
                    $msg->set_message('fail', 'no_employee_available');
                }
        }
    }
    
    if($result_flag && isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
            $employee->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
//    echo '<script>$("#chk_status").val("1"); navigatePage(\'' . $url . '\', 1);</script>';
}
//adding customer
else if ($_REQUEST['action'] == 'add_cust') {
    $result_flag = FALSE;
    $slot_det = $employee->customer_employee_slot_details($_REQUEST['id']);
    if(isset($_REQUEST['select_cust'])) {
        $process_params = array(
                            'employee'      =>  $slot_det['employee'],
                            'customer'      =>  $_REQUEST['select_cust'], 
                            'date'          =>  $slot_det['date'], 
                            'type'          =>  $slot_det['type'], 
                            'time_from'     =>  $slot_det['time_from'], 
                            'time_to'       =>  $slot_det['time_to'], 
                            'comment'       =>  $slot_det['comment']); 
        
        if($employee->findout_slot_alteration_bug($process_params, array($_REQUEST['id']))){
            if($customer->customer_add_to_slot($_REQUEST['id'], $_REQUEST['select_cust'], $_SESSION['user_id']))
                    $result_flag = TRUE;
        }
    }else{
        if ($slot_det['employee'] != '' && $slot_det['customer'] == '') {
            $available_customers = $customer->get_available_customers($slot_det['employee'], $slot_det['date']);
            if(count($available_customers) == 1){
                $process_params = array(
                                    'employee'      =>  $slot_det['employee'],
                                    'customer'      =>  $available_customers[0]['username'], 
                                    'date'          =>  $slot_det['date'], 
                                    'type'          =>  $slot_det['type'], 
                                    'time_from'     =>  $slot_det['time_from'], 
                                    'time_to'       =>  $slot_det['time_to']); 

                if($employee->findout_slot_alteration_bug($process_params, array($_REQUEST['id']))){
                    if($customer->customer_add_to_slot($_REQUEST['id'], $available_customers[0]['username'], $_SESSION['user_id']))
                            $result_flag = TRUE;
                }

            }elseif(empty($available_customers)){
                $msg->set_message('fail', 'no_customer_available');
            }
        }
    }
}
//changing fkkn
else if ($_REQUEST['action'] == 'fkkn') {
    $_SESSION['fkkn'] = $_REQUEST['type'];
    $employee->employee_fkkn_update($_REQUEST['id'], $_REQUEST['type']);
//    echo '<script>$("#chk_status").val("1"); navigatePage(\'' . $url . '\', 1);</script>';
}
//setting direct and prelimminary
else if ($_REQUEST['action'] == 'direct') {
    $employee->employee_direct_preliminary_update($_REQUEST['id'], $_REQUEST['type']);
//    echo '<script>$("#chk_status").val("1"); navigatePage(\'' . $url . '\', 1);</script>';
}
else if ($_REQUEST['action'] == 'memory_slot_remove') {
    $customer->remove_memory_slot($_REQUEST['id']);
//    echo '<script>navigatePage(\'' . $url . '\', 1)</script>';
}
//Adding employee for multiple slots
else if ($_REQUEST['action'] == 'multiple_slot_assign') {
    
    //check schema employee assignment - from gdschema_process_schemaAssign.php
    if(isset($_REQUEST['from_week']) && trim($_REQUEST['from_week']) != '' && isset($_REQUEST['to_week']) && trim($_REQUEST['to_week']) != ''){
        $sel_date = trim($_REQUEST['date']);
//        $sel_employee = trim($_REQUEST['employee']);
//        $sel_customer = trim($_REQUEST['customer']);
        $sel_employee_to_assign = trim($_REQUEST['empl']);
        $sel_ids = trim($_REQUEST['ids']);
        $from_week = trim($_REQUEST['from_week']);
        $to_week = trim($_REQUEST['to_week']);
        $from_option = trim($_REQUEST['from_option']);
        
        $sel_days = explode('-', trim($_REQUEST['days']));
        array_pop($sel_days);
        
        $sel_slots_array = explode(',', $sel_ids);
        foreach($sel_slots_array as $key => $val){
            if(trim($val) == '') unset ($sel_slots_array[$key]);
        }

        $selected_slot_details = $employee->get_multiple_slot_details($sel_slots_array, $sel_date);
        $result_flag = $employee->schema_employee_assign_to_slot_multiple($sel_employee_to_assign, $selected_slot_details, $from_week, $to_week, $from_option, $sel_days);
        
        $dont_show_flag = isset($_REQUEST['dnt_show_flag']) && trim($_REQUEST['dnt_show_flag']) == 1 ? TRUE : FALSE;
        if($dont_show_flag && $result_flag){
            $__slot_employee = $sel_employee_to_assign != '' ? $sel_employee_to_assign : NULL;
            $__slot_customer = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
            $employee->save_customer_employee_general_setting($__slot_customer, $__slot_employee, 'dont_show_slot_operation_flag', 1);
        }
        
        if($result_flag && isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
                $employee->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
    }
    else{
        
        $process_flag = TRUE;
        
        $select_emp = $_REQUEST['empl'];
        $slot_ids = explode(',', $_REQUEST['ids']);
        if(!empty($slot_ids)){
            foreach ($slot_ids as $slot_id) {
                if($slot_id == '') continue;
                $slot_det = $customer->customer_employee_slot_details($slot_id);

                $process_params = array(
                                    'employee'      =>  $select_emp,
                                    'customer'      =>  $slot_det['customer'], 
                                    'date'          =>  $slot_det['date'], 
                                    'time_from'     =>  $slot_det['time_from'], 
                                    'time_to'       =>  $slot_det['time_to']); 

                if(!$employee->findout_slot_alteration_bug($process_params)){
                    $process_flag = false;
                    break;
                }
            }
        }
        
        if($process_flag){
            if($employee->employee_add_to_slot_multiple($_REQUEST['ids'], $_REQUEST['empl'], $_SESSION['user_id'])){
                $msg->set_message('success', 'slot_employee_change_success');
                if($result_flag && isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
                    $employee->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
            }
            else
                $msg->set_message('fail', 'slot_employee_change_fail');
        }
        
        $dont_show_flag = isset($_REQUEST['dnt_show_flag']) && trim($_REQUEST['dnt_show_flag']) == 1 ? TRUE : FALSE;
        if($dont_show_flag){
            $__slot_employee = isset($_REQUEST['empl']) && trim($_REQUEST['empl']) != '' ? trim($_REQUEST['empl']) : NULL;
            $__slot_customer = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
            $employee->save_customer_employee_general_setting($__slot_customer, $__slot_employee, 'dont_show_slot_operation_flag', 1);
        }
    }
//    echo '<script>$("#chk_status").val("1"); navigatePage(\'' . $url . '\', 1);</script>';
}
else if ($_REQUEST['action'] == 'multiple_slot_assign_cust') {
    $customer->customer_add_to_slot_multiple($_REQUEST['ids'], $_REQUEST['cust'], $_SESSION['user_id']);
//    echo '<script>$("#chk_status").val("1"); navigatePage(\'' . $url . '\', 1);</script>';
    if(isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
            $employee->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
}

//create a relation slot (only for leave slot inwhich it have no related slot)
else if ($_REQUEST['action'] == 'clone_leaveslot') {
    $result = $customer->create_relation_slot($_REQUEST['slotid']);
    switch ($result){
        case 'SLOT_NOT_EXIST':
                    $msg->set_message('fail', 'slot_not_exist');
                    break;
        case 'NOT_A_LEAVE_SLOT':
                    $msg->set_message('fail', 'not_a_leave_slot');
                    break;
        case 'ALREADY_HAVE_RELATED_SLOT':
                    $msg->set_message('fail', 'already_have_related_slot');
                    break;
        case 'FAIL_CLONE':
                    $msg->set_message('fail', 'slot_duplication_fail');
                    break;
        case 'SUCCESS_CLONE':
        default :
                    $msg->set_message('success', 'slot_duplication_success');
                    break;
    }
}
else if ($_REQUEST['action'] == 'edit_duration') {
    $slot_det = $employee->customer_employee_slot_details($_REQUEST['id']);
    $slot_from = $dona->time_to_sixty($_REQUEST['slot_from']);
    $slot_to = $dona->time_to_sixty($_REQUEST['slot_to']);
    if($slot_to == 0)
        $slot_to = 24.00;
    
    $resultant_flag = FALSE;
//    customer_employee_slot_add($employee, $customer, $date, $time_from, $time_to, $alloc_emp, $fkkn = 1, $type = 0, $relation_id = '')
    if(floatval($slot_from) >= floatval($slot_to)){
        if($slot_det['employee'] == "" || $slot_det['employee'] == NULL){
            $employee->begin_transaction();
            if($employee->customer_employee_slot_edit($_REQUEST['id'],$slot_from,24.00)){
                if($dona->customer_employee_slot_add($slot_det['employee'], $slot_det['customer'], date('Y-m-d', strtotime('+1 day', strtotime($slot_det['date']))) , 0.00, $slot_to, $slot_det['alloc_emp'], $slot_det['fkkn'], $slot_det['type'],'')){
                    $msg->set_message('success', 'duration_editted_sucessfully');
                    $employee->commit_transaction();
                    $resultant_flag = TRUE;
                }else{
                     $employee->rollback_transaction();
                     $msg->set_message('fail', 'duration_editting_failed');
                }
            }else{
                $employee->rollback_transaction();
                $msg->set_message('fail', 'duration_editting_failed');
            }
        }else{
            if($employee->is_valid_slot_for_edit_duration($slot_det['employee'], $slot_from, 24.00, $slot_det['date'],$_REQUEST['id'])){
                 $employee->begin_transaction();
                if($employee->customer_employee_slot_edit($_REQUEST['id'],$slot_from,24.00)){
//                     $msg->set_message('success', 'duration_editted_sucessfully');
                    if($employee->is_valid_slot($slot_det['employee'], 0.00,$slot_to, date('Y-m-d', strtotime('+1 day', strtotime($slot_det['date']))))){
                        $dona->begin_transaction();
                        if($dona->customer_employee_slot_add($slot_det['employee'], $slot_det['customer'], date('Y-m-d', strtotime('+1 day', strtotime($slot_det['date']))) , 0.00, $slot_to, $slot_det['alloc_emp'], $slot_det['fkkn'], $slot_det['type'])){
                            $msg->set_message('success', 'duration_editted_sucessfully');
                            $employee->commit_transaction();
                            $dona->commit_transaction();
                            $resultant_flag = TRUE;
                        }else{
                           $employee->rollback_transaction();
                           $dona->rollback_transaction();
                           $msg->set_message('fail', 'duration_editting_failed');
                        }
                    }else{
                        $employee->rollback_transaction();
                        $msg->set_message('fail', 'duration_editting_failed');
                    }
                     
                }else{
                    $employee->rollback_transaction();
                    $msg->set_message('fail', 'duration_editting_failed');
                }
            }else{
                
                 $msg->set_message('fail', 'duration_editting_failed');
            }
        }
    }else{
        if($slot_det['employee'] == "" || $slot_det['employee'] == NULL){
            if($employee->customer_employee_slot_edit($_REQUEST['id'],$slot_from,$slot_to)){
                $msg->set_message('success', 'duration_editted_sucessfully');
            }
        }else{
            if($employee->is_valid_slot_for_edit_duration($slot_det['employee'], $slot_from, $slot_to, $slot_det['date'],$_REQUEST['id'])){
                 $employee->begin_transaction();
                if($employee->customer_employee_slot_edit($_REQUEST['id'],$slot_from,$slot_to)){
                     $msg->set_message('success', 'duration_editted_sucessfully');
                     $employee->commit_transaction();
                     $resultant_flag = TRUE;
                }else{
                    $msg->set_message('fail', 'duration_editting_failed');
                    $employee->rollback_transaction();
                }
            }else{
                 $msg->set_message('fail', 'duration_editting_failed');
            }
        }
    }
    
    if($resultant_flag && isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
                $employee->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
}
else if ($_REQUEST['action'] == 'slot_approve_candg') {
    $slot_id = $_REQUEST['id'];
    $dona->approve_candg_slot($slot_id);
}

header('Location: '.$url);
?>