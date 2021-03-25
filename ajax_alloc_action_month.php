<?php
/**
 * @author: Shamsudheen<shamsu@arioninfotech.com>
 * @since 2014-04-08
 * @details
 *      action page for time slots
 *      request from gdschema_month
 */

require_once ('class/setup.php');
require_once ('plugins/message.class.php');
require_once ('class/dona.php');
require_once ('class/employee.php');
require_once ('class/timetable.php');
require_once ('class/customer.php');
require_once ('class/general.php');
require_once ('class/team.php');
require_once ('class/employee_ext.php');

$obj_smarty     = new smartySetup(array("gdschema.xml", "month.xml","button.xml",'messages.xml'), FALSE);
$obj_message    = new message();
$obj_dona       = new dona();
$obj_employee   = new employee();
$obj_timetable  = new timetable();

$page_year      = isset($_REQUEST['pYear'])     ? trim($_REQUEST['pYear']) : '';     //this for monthly view
$page_month     = isset($_REQUEST['pMonth'])    ? trim($_REQUEST['pMonth']) : '';    //this for monthly view
$page_customer  = isset($_REQUEST['pCustomer']) ? trim($_REQUEST['pCustomer']) : ''; //this for monthly/weekly/alloc_window views
$page_employee  = isset($_REQUEST['pEmployee']) ? trim($_REQUEST['pEmployee']) : ''; //this for monthly/weekly/alloc_window views
$page_week_num  = isset($_REQUEST['week_num'])  ? trim($_REQUEST['week_num']) : '';  //this for weekly view
$page_date      = isset($_REQUEST['page_date']) ? trim($_REQUEST['page_date']) : '';  //this for alloc_window view
$page_request_from      = isset($_REQUEST['request_from']) ? trim($_REQUEST['request_from']) : ''; 

if ($page_request_from == 'gd_customer')
    $refresh_page_url = $obj_smarty->url . 'customer/gdschema/'.$page_week_num.'/'.$page_customer.'/8/';
else if ($page_request_from == 'gd_employee')
    $refresh_page_url = $obj_smarty->url . 'employee/gdschema/'.$page_week_num.'/'.$page_employee.'/8/';
else if ($page_request_from == 'gd_alloc_window' && $page_customer != '')
    $refresh_page_url = $obj_smarty->url . 'gdschema_alloc_window.php?customer='.$page_customer.'&date='.$page_date;
else if ($page_request_from == 'gd_alloc_window' && $page_employee != '')
    $refresh_page_url = $obj_smarty->url . 'gdschema_alloc_window_employee.php?employee='.$page_employee.'&date='.$page_date;
else if ($page_request_from == 'gd_monthly_view_employee' && $page_employee != '')
    $refresh_page_url = $obj_smarty->url . "month/gdschema/employee/$page_year/$page_month/$page_employee/";
else
    $refresh_page_url = $obj_smarty->url . "month/gdschema/$page_year/$page_month/$page_customer/";

/**
* @author: Shamsudheen <shamsu@arioninfotech.com>
* for: moving time slot by drag and drop
*/
if ($_REQUEST['action'] == 'drop') {
    
    $process_flag = TRUE;
    $slot_details = $obj_dona->customer_employee_slot_details($_REQUEST['slot_id']);
    
    //check slot exists or not
    if(empty($slot_details)){
        $obj_message->set_message('fail', 'slot_not_exist');
        $process_flag = FALSE;
    }
    
    //Check signed or not in source date
    if($process_flag && $slot_details['employee'] != '' && $slot_details['customer'] != ''){
        if ($obj_employee->chk_employee_rpt_signed($slot_details['employee'], $slot_details['customer'], $slot_details['date'], TRUE))
            $process_flag = FALSE;
    }
    //checking date1 slot is suitable for date2's shift
    if($process_flag){
        $process_params = array(
                            'employee'      =>  $slot_details['employee'],
                            'customer'      =>  $slot_details['customer'], 
                            'date'          =>  $_REQUEST['to_date'], 
                            'type'          =>  $slot_details['type'], 
                            'time_from'     =>  $slot_details['time_from'], 
                            'time_to'       =>  $slot_details['time_to']); 

        //        echo "<pre>".print_r($process_params, 1)."</pre>";
        if(!$obj_employee->findout_slot_alteration_bug($process_params)){
            $process_flag = FALSE;
        }
    }
    
    //proceed transactions
    if($process_flag){
        if($obj_timetable->update_slot_date($_REQUEST['slot_id'], $_REQUEST['to_date']))
            $obj_message->set_message('success', 'slot_successfully_moved');
        else{
            $obj_message->set_message('fail', 'slot_moving_failed');
            $proceed_flag = FALSE;
        }
    }
    
    if(isset($_REQUEST['return_type']) && $_REQUEST['return_type'] == 'json'){
        $obj_return = new stdClass();
        $obj_return->result = $process_flag;
        $obj_return->message = $obj_message->show_message();
        echo json_encode($obj_return);
        exit();
    }
}

else if ($_REQUEST['action'] == 'modify_slot'){
    $obj_customer   = new customer();
    
    $slot_id        = trim($_REQUEST['slot_id']);
    $slot_date      = trim($_REQUEST['slot_date']);
    $slot_time_from = trim($_REQUEST['slot_timefrom']);
    $slot_time_to   = trim($_REQUEST['slot_time_to']);
    $slot_customer  = trim($_REQUEST['slot_customer']);
    $slot_employee  = trim($_REQUEST['slot_employee']) != '' ? trim($_REQUEST['slot_employee']) : NULL;
    $slot_fkkn      = trim($_REQUEST['slot_fkkn']);
    $slot_comment   = trim($_REQUEST['slot_comment']) != '' ? trim($_REQUEST['slot_comment']) : NULL;
    $slot_type      = trim($_REQUEST['slot_type']);
        
    $process_flag = TRUE;
    
    //made simple validation
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
    
    /*if($process_flag && $slot_time_from >= $slot_time_to){
        $process_flag = FALSE;
        $obj_message->set_message('fail', 'time_from_must_less_than_time_to');
    }*/
    
    if($process_flag){
        $slot_details = $obj_dona->customer_employee_slot_details($slot_id);
        
        //to check old slot has already signed or not if employee/customer changed
        if($slot_details['customer'] != '' && $slot_details['employee'] != '' && ($slot_customer != $slot_details['customer'] || $slot_employee != $slot_details['employee'])){
            if($obj_employee->chk_employee_rpt_signed($slot_details['employee'], $slot_details['customer'], $slot_details['date'], TRUE))
                  $process_flag = FALSE;  
        }
    }
    
    if($process_flag){
        
        $slot_time_from  = $obj_dona->time_to_sixty($slot_time_from);
        $slot_time_to    = $obj_dona->time_to_sixty($slot_time_to);
        if($slot_time_to == 0) $slot_time_to = 24;
        $show_msg_exact = array();
        //enters next day
        if($slot_time_from >= $slot_time_to){
            $process_params1 = array(
                'employee'  => $slot_employee,
                'customer'  => $slot_customer,
                'date'      => $slot_date,
                'time_from' => $slot_time_from,
                'time_to'   => 24,
                'type'      => $slot_type,
                'fkkn'      => $slot_fkkn);
            $show_msg_exact[] = $slot_date."=>".sprintf('%05.2f',$slot_time_from)."-".sprintf('%05.2f',24);                                               
            if (!$obj_employee->findout_slot_alteration_bug($process_params1, array($slot_id))) {
                $process_flag = FALSE;
            } else {
                $process_params2 = array(
                    'employee'  => $slot_employee,
                    'customer'  => $slot_customer,
                    'date'      => date('Y-m-d', strtotime(date('Y-m-d', strtotime($slot_date)) . ' +1 day')),
                    'time_from' => 0,
                    'time_to'   => $slot_time_to,
                    'type'      => $slot_type,
                    'fkkn'      => $slot_fkkn);
                $show_msg_exact[] = date('Y-m-d', strtotime(date('Y-m-d', strtotime($slot_date)) . ' +1 day'))."=>".sprintf('%05.2f',0)."-".sprintf('%05.2f',$slot_time_to);    
                if (!$obj_employee->findout_slot_alteration_bug($process_params2)) {
                    $process_flag = FALSE;
                } else {
                    $process_params1['comment'] = $process_params2['comment'] = $slot_comment;
                    //edit first day slot
                    $obj_employee->begin_transaction();
                    $obj_dona->begin_transaction();
                    $process_flag = $obj_employee->update_slot_details($slot_id, $process_params1);
                    
                    //create new slot in next day
                    if($process_flag){
                        $process_flag = $obj_dona->customer_employee_slot_add($process_params2['employee'], $process_params2['customer'], $process_params2['date'], $process_params2['time_from'], $process_params2['time_to'], $_SESSION['user_id'], $process_params2['fkkn'], $process_params2['type'], '', $process_params2['comment']);
                    }
                    
                    if(!$process_flag){
                        $obj_employee->rollback_transaction();
                        $obj_dona->rollback_transaction();
                        $obj_message->set_message('fail', 'slot_editting_failed');
                    }else{
                        $obj_employee->commit_transaction();
                        $obj_dona->commit_transaction();
                        $obj_message->set_message('success', 'slot_editting_success');
                        $obj_message->set_message_exact('success', $smarty->translate['several_slot_added']);
                    }
                }
            }
        }
        else{
            $process_params = array(
                'employee'  => $slot_employee,
                'customer'  => $slot_customer,
                'date'      => $slot_date,
                'time_from' => $slot_time_from,
                'time_to'   => $slot_time_to,
                'type'      => $slot_type,
                'fkkn'      => $slot_fkkn);
            $show_msg_exact[] = $slot_date."=>".sprintf('%05.2f',$slot_time_from)."-".sprintf('%05.2f',$slot_time_to);                                               
            if (!$obj_employee->findout_slot_alteration_bug($process_params, array($slot_id))) {
                $process_flag = FALSE;
            } else {
                $process_params['comment'] = $slot_comment;
                $process_flag = $obj_employee->update_slot_details($slot_id, $process_params);
                
                if(!$process_flag)
                    $obj_message->set_message('fail', 'slot_editting_failed');
                
                //add other employees to personal meeting 
                $slot_type      = trim($_REQUEST['slot_type']);
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
                                  if no, get slots which have specified employee with specified customer */
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
                }
                
                if($process_flag){
                    $obj_message->set_message('success', 'slot_editting_success');
                    $obj_message->set_message_exact('success', $show_msg_exact[0]);
                    
                }

            }
        }
    }
//    echo $process_flag ? 'T' : 'F';
    
    $obj_return = new stdClass();
    $obj_return->transaction = $process_flag;
//    $obj_return->message = $obj_message->show_message();
    echo json_encode($obj_return);
    exit();
}

else if ($_REQUEST['action'] == 'check_slot_credentials'){
    
    $obj_return = new stdClass();
    $obj_customer   = new customer();
    $slot_id        = trim($_REQUEST['slot_id']);
    $slot_details = $obj_dona->customer_employee_slot_details($slot_id);
    
    //find tl-flag
    $tl_flag = FALSE;
    if($slot_details['customer'] != '' && $slot_details['employee'] != ''){
        if($obj_employee->check_login_employee_to_access_employee($slot_details['employee']) && $obj_customer->check_login_employee_to_access_customer($slot_details['customer']))
            $tl_flag = TRUE;
    }elseif($slot_details['employee'] != '')
        $tl_flag = $obj_employee->check_login_employee_to_access_employee($slot_details['employee']);
    elseif($slot_details['customer'] != '')
        $tl_flag = $obj_customer->check_login_employee_to_access_customer($slot_details['customer']);

    $obj_return->tl_flag = $tl_flag;
    $obj_return->swap_button_hide = (isset($_SESSION['swap']) && $slot_id == $_SESSION['swap'] ? 1 : 0);
    $obj_return->swap_var = isset($_SESSION['swap']) ? $_SESSION['swap'] : '';

    
    echo json_encode($obj_return);
    exit();
}

else if($_REQUEST['action'] == 'drag_memory_slots'){
    $employee_to_add        = isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
    $customer_to_add        = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
    
    $obj_return = new stdClass();
    $transaction_flag = TRUE;
    if($employee_to_add == '' && $customer_to_add == ''){
         $obj_message->set_message('fail', 'no_employee_and_customer_selected');
         $transaction_flag = FALSE;
    }
    else if ($employee_to_add != '' && $customer_to_add != '') {
        if ($obj_employee->chk_employee_rpt_signed($employee_to_add, $customer_to_add, $_REQUEST['date'], TRUE) == 1)
            $transaction_flag = FALSE;
    }
    if ($transaction_flag) {
        //multiple memory slot checks and create all at one click
        if (isset($_REQUEST['multiple']) && $_REQUEST['multiple'] != "") {
            
            $multiple_time_slot = explode(",", $_REQUEST['multiple']);
            
            //check multiple memory slots collided together
            if($employee_to_add != ''){
                $first_day_slots = $second_day_slots = array();
                for ($i = 0; $i < count($multiple_time_slot); $i++) {
                    $time_slot = explode("-", $multiple_time_slot[$i]);
                    if ($time_slot[0] > $time_slot[1]) {
                        $first_day_slots[] = array('time_from' => $time_slot[0], 'time_to'   => 24);
                        $second_day_slots[] = array('time_from' => 0, 'time_to'   => $time_slot[1]);
                    }
                    else 
                        $first_day_slots[] = array('time_from' => $time_slot[0], 'time_to'   => $time_slot[1]);
                }
                
                $flag_employee_slots_collided = FALSE;
                if(!empty($first_day_slots)){
                    $count_first_day_slots = count($first_day_slots);
                    for($p = 1 ; $p < $count_first_day_slots ; $p++){
                        for($q = 0 ; $q < $p ; $q++){
                            if(($first_day_slots[$q]['time_from'] >= $first_day_slots[$p]['time_from'] && $first_day_slots[$q]['time_from'] <  $first_day_slots[$p]['time_to']) ||
                                ($first_day_slots[$q]['time_to'] > $first_day_slots[$p]['time_from'] && $first_day_slots[$q]['time_to'] <= $first_day_slots[$p]['time_to']) ||
                                ($first_day_slots[$q]['time_from'] < $first_day_slots[$p]['time_from'] && $first_day_slots[$q]['time_to'] > $first_day_slots[$p]['time_to'])){
                                    $flag_employee_slots_collided = TRUE;
                                    break;
                            }
                        }
                        if($flag_employee_slots_collided) break;
                    }
                }
                if(!$flag_employee_slots_collided && !empty($second_day_slots)){
                    $count_second_day_slots = count($second_day_slots);
                    for($p = 1 ; $p < $count_second_day_slots ; $p++){
                        for($q = 0 ; $q < $p ; $q++){
                            if(($second_day_slots[$q]['time_from'] >= $second_day_slots[$p]['time_from'] && $second_day_slots[$q]['time_from'] <  $second_day_slots[$p]['time_to']) ||
                                ($second_day_slots[$q]['time_to'] > $second_day_slots[$p]['time_from'] && $second_day_slots[$q]['time_to'] <= $second_day_slots[$p]['time_to']) ||
                                ($second_day_slots[$q]['time_from'] < $second_day_slots[$p]['time_from'] && $second_day_slots[$q]['time_to'] > $second_day_slots[$p]['time_to'])){
                                    $flag_employee_slots_collided = TRUE;
                                    break;
                            }
                        }
                        if($flag_employee_slots_collided) break;
                    }
                }
                
                if($flag_employee_slots_collided){
                    $transaction_flag = FALSE;
                    $obj_message->set_message('fail', 'employee_slots_collided_within_entered_slots');
                }
            }
            if ($transaction_flag){
                $obj_dona->begin_transaction();
                for ($i = 0; $i < count($multiple_time_slot); $i++) {
                    $time_slot = explode("-", $multiple_time_slot[$i]);
                    if ($time_slot[0] > $time_slot[1]) {
                        $next_date = date('Y-m-d', strtotime($_REQUEST['date'] . "+1 days"));
                        $process_params = array(
                            'employee'  => $employee_to_add,
                            'customer'  => $customer_to_add,
                            'date'      => $_REQUEST['date'],
                            'type'      => $time_slot[2],
                            'time_from' => $time_slot[0],
                            'time_to'   => 24);

                        if (!$obj_employee->findout_slot_alteration_bug($process_params)) {
                            $transaction_flag = FALSE;
                            break;
                        }
                        if ($transaction_flag) {
                            $process_params = array(
                                'employee'  => $employee_to_add,
                                'customer'  => $customer_to_add,
                                'date'      => $next_date,
                                'type'      => $time_slot[2],
                                'time_from' => 0,
                                'time_to'   => $time_slot[1]);

                            if (!$obj_employee->findout_slot_alteration_bug($process_params)) {
                                $transaction_flag = FALSE;
                                break;
                            }
                        }
                        if ($transaction_flag) {
                            if (!$obj_dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $time_slot[0], 24, (isset($_REQUEST['emp_alloc']) ? $_REQUEST['emp_alloc'] : ''), '', $time_slot[2])) {
                                $transaction_flag = FALSE;
                                $obj_message->set_message('fail', 'slot_create_fail');
                                break;
                            }
                            if (!$obj_dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $next_date, 0, $time_slot[1], (isset($_REQUEST['emp_alloc']) ? $_REQUEST['emp_alloc'] : ''), '', $time_slot[2])) {
                                $transaction_flag = FALSE;
                                $obj_message->set_message('fail', 'slot_create_fail');
                                break;
                            }
                        }
                    } else {
                        $process_params = array(
                            'employee'  => $employee_to_add,
                            'customer'  => $customer_to_add,
                            'date'      => $_REQUEST['date'],
                            'type'      => $time_slot[2],
                            'time_from' => $time_slot[0],
                            'time_to'   => $time_slot[1]);

                        if (!$obj_employee->findout_slot_alteration_bug($process_params)) {
                            $transaction_flag = FALSE;
                            break;
                        }

                        if (!$obj_dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $time_slot[0], $time_slot[1], (isset($_REQUEST['emp_alloc']) ? $_REQUEST['emp_alloc'] : ''), '', $time_slot[2])) {
                            $transaction_flag = FALSE;
                            $obj_message->set_message('fail', 'slot_create_fail');
                            break;
                        }
                    }
                }
                if ($transaction_flag){
                    $obj_dona->commit_transaction();
                    $obj_message->set_message('success', 'slot_created_success');
                }else{
                    $obj_dona->rollback_transaction();
                }
            }
        }
        
        //drag and drop one single memory slot
        else {
            $memslot_type = isset($_REQUEST['slotType']) ? trim($_REQUEST['slotType']) : '';
            if ($_REQUEST['time_from'] >= $_REQUEST['time_to']) {

                $cur_date = strtotime($_REQUEST['date'] . ' 00:00:00');
                $next_date = date('Y-m-d', ($cur_date + 24 * 3600));
                $transaction_flag = TRUE;


                $process_params = array(
                    'employee'  => $employee_to_add,
                    'customer'  => $customer_to_add,
                    'date'      => $_REQUEST['date'],
                    'type'      => $memslot_type,
                    'time_from' => $_REQUEST['time_from'],
                    'time_to'   => 24);

                if (!$obj_employee->findout_slot_alteration_bug($process_params))
                    $transaction_flag = FALSE;


                if ($transaction_flag) {
                    $process_params = array(
                        'employee'  => $employee_to_add,
                        'customer'  => $customer_to_add,
                        'date'      => $next_date,
                        'type'      => $memslot_type,
                        'time_from' => 0,
                        'time_to'   => $_REQUEST['time_to']);
                    if (!$obj_employee->findout_slot_alteration_bug($process_params))
                        $transaction_flag = FALSE;
                }

                if ($transaction_flag) {
                    if ($obj_dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $_REQUEST['time_from'], 24, (isset($_REQUEST['emp_alloc']) ? $_REQUEST['emp_alloc'] : ''), '', $memslot_type))
                        $obj_message->set_message('success', 'slot_created_success');
                    else {
                        $obj_message->set_message('fail', 'slot_create_fail');
                        $transaction_flag = FALSE;
                    }
                    
                    if ($obj_dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $next_date, 0, $_REQUEST['time_to'], (isset($_REQUEST['emp_alloc']) ? $_REQUEST['emp_alloc'] : ''), '', $memslot_type)) 
                        $obj_message->set_message('success', 'slot_created_success');
                    else {
                        $obj_message->set_message('fail', 'slot_create_fail');
                        $transaction_flag = FALSE;
                    }
                }
            } else {
                $process_params = array(
                    'employee'  => $employee_to_add,
                    'customer'  => $customer_to_add,
                    'date'      => $_REQUEST['date'],
                    'type'      => $memslot_type,
                    'time_from' => $_REQUEST['time_from'],
                    'time_to'   => $_REQUEST['time_to']);

//                $obj_return->data_set = $process_params;
                if ($obj_employee->findout_slot_alteration_bug($process_params)) {
                    if ($obj_dona->customer_employee_slot_add($employee_to_add, $customer_to_add, $_REQUEST['date'], $_REQUEST['time_from'], $_REQUEST['time_to'], (isset($_REQUEST['emp_alloc']) ? $_REQUEST['emp_alloc'] : ''), '', $memslot_type)) {
                        $obj_message->set_message('success', 'slot_created_success');
//                        if (isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
//                            $obj_employee->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
                    } else{
                        $obj_message->set_message('fail', 'slot_create_fail');
                        $transaction_flag = FALSE;
                    }
                } else {
                    //echo "here";
                    $transaction_flag = FALSE;
                }
            }
        }
        $dont_show_flag = isset($_REQUEST['dnt_show_flag']) && trim($_REQUEST['dnt_show_flag']) == 1 ? TRUE : FALSE;
        if ($dont_show_flag) {
            $__slot_employee = isset($_REQUEST['employee']) && trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
            $__slot_customer = isset($_REQUEST['customer']) && trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
            $obj_employee->save_customer_employee_general_setting($__slot_customer, $__slot_employee, 'dont_show_slot_operation_flag', 1);
        }
    }
    
    $obj_return->result = $transaction_flag;
    if(!$transaction_flag)  // display message only if any error arrises
        $obj_return->message = $obj_message->show_message();
    
    echo json_encode($obj_return);
    exit();
}

else if($_REQUEST['action'] == 'memory_slot_remove') {
    $obj_customer   = new customer();
    $transaction_flag = $obj_customer->remove_memory_slot($_REQUEST['id']);
    if($transaction_flag)
        $obj_message->set_message ('success', 'memory_slot_delete_success');
    else
        $obj_message->set_message ('fail', 'memory_slot_delete_fail');
    
    $obj_return = new stdClass();
    $obj_return->result = $transaction_flag;
    $obj_return->message = $obj_message->show_message();
    
    echo json_encode($obj_return);
    exit();
}

else if($_REQUEST['action'] == 'avail_employees_for_multiple_slot_change'){
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
    $slots_detail = $obj_dona->customer_employee_multi_slot_details($slot_ids);
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
                    $available_users = $obj_employee->get_available_users($slots_detail[$i]['customer'], $slots_detail[$i]['time_from'], $slots_detail[$i]['time_to'], $slots_detail[$i]['date']);
                    $employees_to_add = $obj_employee->employee_intersect($available_users, $employees_to_add);
                }else{
                    $employees_to_add = $obj_employee->get_available_users($slots_detail[$i]['customer'], $slots_detail[$i]['time_from'], $slots_detail[$i]['time_to'], $slots_detail[$i]['date']);
                }
        }else{
           $employees_to_add = $obj_employee->get_available_users($slots_detail[$i]['customer'], $slots_detail[$i]['time_from'], $slots_detail[$i]['time_to'], $slots_detail[$i]['date']); 
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
    echo json_encode($obj_return);
    exit();
}

else if($_REQUEST['action'] == 'avail_customers_for_multiple_slot_change'){
    $obj_customer   = new customer();
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
    
    $obj_employee->flush();
    $accessible_employees = $obj_customer->customer_list();

    //get selected slot details
    $obj_employee->flush();
    $slots_detail = $obj_dona->customer_employee_multi_slot_details($slot_ids);
    $slots_count = count($slots_detail);
    $slot_employees = array();
    // filter unique employees from selected slots
    for($i = 0 ; $i< $slots_count ; $i++){
        if($slots_detail[$i]['employee'] != '' && $slots_detail[$i]['employee'] != NULL){
            if(!in_array($slots_detail[$i]['employee'], $slot_employees))
                $slot_employees[] = $slots_detail[$i]['employee'];
        }
    }

    //get mutual customers of employees(team) 
    $mutual_customers = array();
    if(!empty($slot_employees))
        $mutual_customers = $obj_employee->get_mutual_customers_of_employees($slot_employees);
    else
        $mutual_customers = $accessible_employees;

    //-------------------------------------------------------------------------------

    $common_customers = array_uintersect($accessible_employees, $mutual_customers, function($value1, $value2) {
                                return strcmp($value1['username'], $value2['username']);
                             });
               
    //find ordered names
    if(!empty($common_customers)){
        foreach($common_customers as $key => $common_customer)
            $common_customers[$key]['ordered_name'] = isset($_SESSION['company_sort_by']) && $_SESSION['company_sort_by'] == 1 ? $common_customer['first_name'].' '.$common_customer['last_name'] : $common_customer['last_name'].' '.$common_customer['first_name'];
        
        $common_customers = array_values($common_customers);
    }
//        echo "<pre>".print_r($common_customers, 1)."</pre>"; exit();
    
    $obj_return = new stdClass();
    $obj_return->avail_customers = $common_customers;
    if(empty($common_customers))
        $obj_return->message = $obj_smarty->translate['no_data_available'];
    echo json_encode($obj_return);
    exit();
}

else if ($_REQUEST['action'] == 'rep_emp_load') {

    $start_date = isset($_REQUEST['start_date']) ? trim($_REQUEST['start_date']) : '';
    $end_date = isset($_REQUEST['end_date']) ? trim($_REQUEST['end_date']) : '';
    $selected_emp = isset($_REQUEST['selected_emp']) ? trim($_REQUEST['selected_emp']) : '';
    $sel_customer = isset($_REQUEST['sel_customer']) ? trim($_REQUEST['sel_customer']) : '';

    $is_customer_checked = isset($_REQUEST['is_customer_checked']) ? trim($_REQUEST['is_customer_checked']) : '';
    $considered_customer = $is_customer_checked == 1 ? $sel_customer : NULL;

    $obj_return = new stdClass();
    $avail_employees = array();

    if ($start_date != '' && $end_date != '' && $selected_emp != '') {
        $replacing_slots = $obj_dona->get_employee_slots_btwn_dates($selected_emp, $start_date, $end_date, $considered_customer);
        $temp_emps_prev = array();
        if (!empty($replacing_slots)) {
            foreach ($replacing_slots as $slot_data) {
                $avail_replace_employees = $obj_employee->get_available_users($slot_data['customer'], $slot_data['time_from'], $slot_data['time_to'], $slot_data['date']);
                if (!empty($avail_replace_employees)) {
                    if (empty($avail_employees)) {
                        foreach ($avail_replace_employees as $avail_replace_employee) {
                            $avail_employees[$avail_replace_employee['username']] = $avail_replace_employee;
                        }
                    } else {
                        $temp_emps_prev = array();
                        foreach ($avail_replace_employees as $avail_replace_employee) {
                            $temp_emps_prev[] = $avail_replace_employee['username'];
                        }
                        foreach ($avail_employees as $key => $value) {
                            if (!in_array($key, $temp_emps_prev))
                                unset($avail_employees[$key]);
                        }
                    }
                }else {
                    $avail_employees = array();
                    break;
                }
            }
        }
    }

    if (!empty($avail_employees)) {
        foreach ($avail_employees as $key => $employee) {
            if ($employee['username'] == $selected_emp)
                unset($avail_employees[$key]);
//                echo '<label><input type="radio" class="rep_radio_rep" name="employee" value = "' . $employee['username'] . '">' . $employee['name'] . '</label><br />';
        }
        $avail_employees = array_values($avail_employees);
    }

    $obj_return->avail_employees = $avail_employees;
    if (empty($avail_employees))
        $obj_return->message = $obj_smarty->translate['no_available_employees_for_replacement'];
    echo json_encode($obj_return);
    exit();
}

else if ($_REQUEST['action'] == 'avail_emps_for_sms_allotment') {
    $ids = $_REQUEST['ids'];
    $slots = explode("-", $ids);
    $count_slots = count($slots);
    $slot_ids = "";
    for ($i = 0; $i < $count_slots; $i++) {
        if ($slots[$i] != "")
            $slot_ids = $slot_ids == "" ? $slots[$i] : $slot_ids . "," . $slots[$i];
    }
    $available_employees = $obj_employee->get_available_employees_for_selected_slots($slot_ids);
    
    $obj_return = new stdClass();
    $obj_return->avail_employees = $available_employees;
    echo json_encode($obj_return);
    exit();
}

else if($_REQUEST['action'] == 'swap_switch_2_slots'){
    $ids = $_REQUEST['ids'];
    $slots = explode("-", $ids);
    $count_slots = count($slots);
    
    $proceed_flag = TRUE;
    if($count_slots != 2){
        $proceed_flag = FALSE;
        $obj_message->set_message('fail', 'you_must_select_2_slots'); 
    }
    
    if($proceed_flag){
        $proceed_flag = $obj_employee->employee_swap($slots[0], $slots[1]);
        if($proceed_flag)
            $obj_message->set_message('success', 'swap_success'); 
    }
    
    $obj_return = new stdClass();
    $obj_return->result = $proceed_flag;
    if(!$proceed_flag)
        $obj_return->message = $obj_message->show_message();
    
    echo json_encode($obj_return);
    exit();
}

else if ($_REQUEST['action'] == 'get_day_slots'){
    
    $obj_general        = new general();
    $obj_return         = new stdClass();
    $obj_customer       = new customer();
    $selected_date      = isset($_REQUEST['date']) ? trim($_REQUEST['date']) : '';
    $selected_customer  = isset($_REQUEST['pCustomer']) ? trim($_REQUEST['pCustomer']) : '';
    
    $selected_day_slots = $obj_timetable->customer_slots_btwn_dates($selected_customer, $selected_date, $selected_date);
    
    //finding leave details only for leave slots
    foreach ($selected_day_slots as $key => $slot) {
        if($slot['status'] == 2){ //getting leave slots only
            $temp_leave_data = $obj_employee->get_leave_details_byTimeTable_data($slot['employee'], $slot['date'], $slot['time_from'], $slot['time_to']);
            $selected_day_slots[$key]['leave_data'] = $temp_leave_data[0];
            $selected_day_slots[$key]['leave_data']['leave_name'] = $obj_smarty->leave_type[$temp_leave_data[0]['type']];
        
            $related_slot = $obj_employee->check_relations_in_timetable_for_leave($slot['id']);
            if(!empty($related_slot))
                $selected_day_slots[$key]['leave_data']['is_exist_relation'] = 1;
            else
                $selected_day_slots[$key]['leave_data']['is_exist_relation'] = 0;
        }
    }
    

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
else if ($_REQUEST['action'] == 'get_team_not_signed_customers'){
    $obj_team = new team();
    $obj_company = new company();
    $obj_return         = new stdClass();
    $selected_employee  = trim($_REQUEST['employee']);
    $selected_date  = trim($_REQUEST['date']);
    if($selected_employee != '' && $selected_date != ''){
        //$obj_return->customers = $obj_employee->get_team_customers_of_employee($selected_employee);

        $month_sdate = date('Y-m-01', strtotime($selected_date));

        $obj_return->customers = $obj_team->customers_for_employee_team_gdschema_alloc($selected_employee, $month_sdate);
        // echo '<pre>'.print_r($obj_return->customers, 1).'</pre>';
    }
    
    echo json_encode($obj_return);
    exit();
}
else if ($_REQUEST['action'] == 'get_team_not_signed_employees'){
    $obj_team = new team();
    $obj_company = new company();
    $obj_return         = new stdClass();
    $selected_customer  = trim($_REQUEST['customer']);
    $selected_date  = trim($_REQUEST['date']);
    if($selected_customer != '' && $selected_date != ''){
        $month_sdate = date('Y-m-01', strtotime($selected_date));
        $obj_return->employees = $obj_team->employees_for_customer_team_gdschema_alloc($selected_customer, $month_sdate, FALSE);
        // echo '<pre>'.print_r($obj_return->employees, 1).'</pre>';
    }
    
    echo json_encode($obj_return);
    exit();
}

else if($_REQUEST['action'] == 'change_slot_time'){
    $obj_emp_ext = new employee_ext();
    $responce    = new stdClass();
    
    $ids         = $_REQUEST['ids'];
    $time_from   = $_REQUEST['time_from'];
    $time_to     = $_REQUEST['time_to'];
    $break       = FALSE;

    $time_from  = $obj_dona->time_to_sixty($time_from);
    $time_to    = $obj_dona->time_to_sixty($time_to);
    if($time_to == 0) $time_to = 24;

    $slots_details = $obj_dona->customer_employee_multi_slot_details($ids);

    foreach ($slots_details as $key => $slots) {
        $changed_slot_det[$slots['date']][] = $slots['employee'];
    }
    foreach ($changed_slot_det as $date => $employees) {
        foreach ($employees as $key => $value) {
            if(count(array_keys($employees, $value)) > 1){
                $break                   = true;
                $emp_name                = $obj_dona->get_employee_name($value);
                $error_message_translate = $obj_smarty->translate['employee_present_multiple_time_date'];
                $error_message           = str_replace ('{{employee}}', $emp_name, $error_message_translate);
                $error_message           = str_replace ('{{date}}', $date , $error_message);
                $obj_message->set_message_exact('fail', $error_message);
                break;
            }
         }
         if($break == true)
            break;         
    }
    if($break == true){ // multiple employee in same date, no further cheking is needed,
        $responce->result_flag   = FALSE;
        $responce->error_message =  $obj_message->show_message();
    }
    else{ // further check employee avialable at changed time.        
         $break = FALSE;
         foreach ($slots_details as $key => $value) {
            if($value['employee'] != ''){
                $available_users = $obj_employee->get_available_users($value['customer'], $time_from, $time_to, $value['date'], $value['employee'], $value['id']);
                if(empty($available_users)){
                    $emp_name = $_SESSION['company_sort_by'] == 1 ? $value['emp_first_name'].' '.$value['emp_last_name'] : $value['emp_last_name'].' '.$value['emp_first_name'] ;
                    $break = TRUE;
                    $error_message_translate = $obj_smarty->translate['employee_not_available_in_change_time'];
                    $error_message = str_replace ('{{employee}}', $emp_name, $error_message_translate);
                    $error_message = str_replace ('{{date}}', $value['date'] , $error_message);
                    $error_message = str_replace ('{{time_from}}', sprintf('%05.02f', $time_from) , $error_message);
                    $error_message = str_replace ('{{time_to}}', sprintf('%05.02f', $time_to) , $error_message);
                    $obj_message->set_message_exact('fail',$error_message);
                    break;
                }
            }
         }
         if($break == true){ // error due to non-availability of user
            $responce->result_flag   = FALSE;
            $responce->error_message =  $obj_message->show_message();
         }
         else{ // saving new time to slots.
            $obj_emp_ext->save_new_time_to_slots($time_from,$time_to,$ids);
            $responce->result_flag = TRUE;
            $obj_message->set_message('success', 'employee_time_changed_sucessfully');
         }
    }
  
    echo json_encode($responce);
    exit();
}

header('Location: '.$refresh_page_url);
?>