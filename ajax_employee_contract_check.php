<?php
// error_reporting(E_ALL);
// error_reporting(E_WARNING);
// ini_set('error_reporting', E_ALL);
// ini_set("display_errors", 1);

/**
 * @author: Shamsudheen<shamsu@arioninfotech.com>
 * for: check whether employee contract hours exceeded or not
 * rule: should accept parameters only as $_REQUEST mode... (because it might called from ajax_check_atl_and_contract.php)
*/
require_once('class/setup.php');
require_once('class/employee.php');
require_once('class/user.php');
$employee = new employee();
$obj_user = new user();
$emp_contract_check = 1;
$return_obj = array( 'contract' => 'success');
$process_normal_slot_types = '0,1,2,4,5,6,7,8,10';
$process_oncall_slot_types = '3,9,14';
$process_normal_slot_types_array = explode(',', $process_normal_slot_types);
$process_oncall_slot_types_array = explode(',', $process_oncall_slot_types);

if($_REQUEST['type_check'] == 1){
    $customer_to_add = $_REQUEST['customer'] != '' ? trim($_REQUEST['customer']) : ($_REQUEST['cust'] != '' ? trim($_REQUEST['cust']) : NULL);
    $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($_REQUEST['empl'], $_REQUEST['date'], $_REQUEST['ids'], array(), array(), $customer_to_add, FALSE, TRUE);
    $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

    $this_year_week = date('o|W', strtotime($_REQUEST['date']));
    // $emp_contract_check = $employee->check_employee_contract($_REQUEST['empl'],$_REQUEST['date'],$employee_work_hours);
    $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($_REQUEST['empl'], $this_year_week, TRUE, $customer_to_add);
    $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
    if($check_flag !== TRUE){
        $return_obj['contract'] = 'fail';
        $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
        $return_obj['contract_params'] = make_contract_fail_array($employee, $_REQUEST['empl'], $_REQUEST['date'], $error_array);
    }
}
else if($_REQUEST['type_check'] == 2){
    $slot_det = $employee->customer_employee_slot_details($_REQUEST['id']);
    $employee_to_add = $_REQUEST['emp_new'] != '' ? trim($_REQUEST['emp_new']) : ($_REQUEST['select_emp'] != '' ? trim($_REQUEST['select_emp']) : NULL);

    if($slot_det['customer'] != '' && $employee_to_add != ''){
        $updating_records = array(array('time_from' => $slot_det['time_from'], 'time_to' => $slot_det['time_to'], 'type' => $slot_det['type']));

        $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($employee_to_add, $_REQUEST['date'], array(), $updating_records, array($_REQUEST['id']), $slot_det['customer'], FALSE, TRUE);
        $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

        $this_year_week = date('o|W', strtotime($_REQUEST['date']));
        // $emp_contract_check = $employee->check_employee_contract($_REQUEST['select_emp'],$_REQUEST['date'],$employee_work_hours);
        $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($employee_to_add, $this_year_week, TRUE, $slot_det['customer']);
        $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
        if($check_flag !== TRUE){
            $return_obj['contract'] = 'fail';
            $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
            $return_obj['contract_params'] = make_contract_fail_array($employee, $employee_to_add, $_REQUEST['date'], $error_array);
        }
    }
}
else if($_REQUEST['type_check'] == 3 && $_REQUEST['employee'] != ""){
    
    $multiple = trim($_REQUEST['multiple']);
    $multiple_array = array();
    if($multiple != NULL){
        $slots = explode(",", $multiple);
        $slots_count = count($slots);
        for($i=0; $i< $slots_count; $i++){
            if(trim($slots[$i]) == '') continue;
            $slot_params = explode("-",$slots[$i]);
            $multiple_array[] = array('time_from' => trim($slot_params[0]), 'time_to' => trim($slot_params[1]), 'type' => trim($slot_params[2]));
        }
    }

    $customer_to_add = $_REQUEST['customer'] != '' ? trim($_REQUEST['customer']) : NULL;
    
    $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($_REQUEST['employee'], $_REQUEST['date'], array(), $multiple_array, array(), $customer_to_add, FALSE, TRUE);
    $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

    $this_year_week = date('o|W', strtotime($_REQUEST['date']));
    // $emp_contract_check = $employee->check_employee_contract($_REQUEST['employee'],$_REQUEST['date'],$employee_work_hours);
    $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($_REQUEST['employee'], $this_year_week, TRUE, $customer_to_add);
    $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
    if($check_flag !== TRUE){
        $return_obj['contract'] = 'fail';
        $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
        $return_obj['contract_params'] = make_contract_fail_array($employee, $_REQUEST['employee'], $_REQUEST['date'], $error_array);
    }
}
else if($_REQUEST['type_check'] == 4 && $_REQUEST['employee'] == ""){
    if($_SESSION['user_role'] == 3){
        $customer_to_add = $_REQUEST['customer'] != '' ? trim($_REQUEST['customer']) : NULL;
        
        $multiple_array = array(array('time_from' => $_REQUEST['time_from'], 'time_to' => $_REQUEST['time_to'], 'type' => $_REQUEST['slotType']));
        $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($_SESSION['user_id'], $_REQUEST['date'], array(), $multiple_array, array(), $customer_to_add, FALSE, TRUE);
        $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

        $this_year_week = date('o|W', strtotime($_REQUEST['date']));
        // $emp_contract_check = $employee->check_employee_contract($_SESSION['user_id'],$_REQUEST['date'],$employee_work_hours);
        $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($_SESSION['user_id'], $this_year_week, TRUE, $customer_to_add);
        $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
        if($check_flag !== TRUE){
            $return_obj['contract'] = 'fail';
            $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
            $return_obj['contract_params'] = make_contract_fail_array($employee, $_SESSION['user_id'], $_REQUEST['date'], $error_array);
        }
    }
}
else if($_REQUEST['type_check'] == 4 && $_REQUEST['employee'] != ""){
    $customer_to_add = $_REQUEST['customer'] != '' ? trim($_REQUEST['customer']) : NULL;

    $multiple_array = array(array('time_from' => $_REQUEST['time_from'], 'time_to' => $_REQUEST['time_to'], 'type' => $_REQUEST['slotType']));
    $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($_REQUEST['employee'], $_REQUEST['date'], array(), $multiple_array, array(), $customer_to_add, FALSE, TRUE);
    $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));
    
    $this_year_week = date('o|W', strtotime($_REQUEST['date']));
    // $emp_contract_check = $employee->check_employee_contract($_REQUEST['employee'],$_REQUEST['date'],$employee_work_hours);
    $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($_REQUEST['employee'], $this_year_week, TRUE, $customer_to_add);
    $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
    if($check_flag !== TRUE){
        $return_obj['contract'] = 'fail';
        $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
        $return_obj['contract_params'] = make_contract_fail_array($employee, $_REQUEST['employee'], $_REQUEST['date'], $error_array);
    }
}
else if($_REQUEST['type_check'] == 5){
    $customer_to_add = $_REQUEST['customer'] != '' ? trim($_REQUEST['customer']) : NULL;

    $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($_REQUEST['employee'], $_REQUEST['date'], $_REQUEST['ids'], array(), array(), $customer_to_add, FALSE, TRUE);
    $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

    $this_year_week = date('o|W', strtotime($_REQUEST['date']));
    // $emp_contract_check = $employee->check_employee_contract($_REQUEST['employee'], $_REQUEST['date'], $employee_work_hours);
    $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($_REQUEST['employee'], $this_year_week, TRUE, $customer_to_add);
    $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
    if($check_flag !== TRUE){
        $return_obj['contract'] = 'fail';
        $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
        $return_obj['contract_params'] = make_contract_fail_array($employee, $_REQUEST['employee'], $_REQUEST['date'], $error_array);
    }
}
else if($_REQUEST['type_check'] == 6){
    $customer_to_add = $_REQUEST['cust_new'] != '' ? trim($_REQUEST['cust_new']) : ($_REQUEST['customer'] != '' ? trim($_REQUEST['customer']) : NULL);

    if($customer_to_add != '' && $_REQUEST['employee'] != ''){
        $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($_REQUEST['employee'], $_REQUEST['date'], $_REQUEST['id'], array(), array(), $customer_to_add, FALSE, TRUE);
        $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

        $this_year_week = date('o|W', strtotime($_REQUEST['date']));
        // $emp_contract_check = $employee->check_employee_contract($_REQUEST['employee'],$_REQUEST['date'],$employee_work_hours);
        $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($_REQUEST['employee'], $this_year_week, TRUE, $customer_to_add);
        $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
        if($check_flag !== TRUE){
            $return_obj['contract'] = 'fail';
            $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
            $return_obj['contract_params'] = make_contract_fail_array($employee, $_REQUEST['employee'], $_REQUEST['date'], $error_array);
        }
    }
}
else if($_REQUEST['type_check'] == 7){
    if($_REQUEST['action'] == 'add_cust'){
        $customer_to_add = $_REQUEST['cust_new'] != '' ? trim($_REQUEST['cust_new']) : ($_REQUEST['customer'] != '' ? trim($_REQUEST['customer']) : NULL);
        $slot_det = $employee->customer_employee_slot_details($_REQUEST['id']);
        if($slot_det['employee'] != '' && $customer_to_add != ''){
            $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($slot_det['employee'], $_REQUEST['date'],$_REQUEST['id'], array(), array(), $customer_to_add, FALSE, TRUE);
            $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

            $this_year_week = date('o|W', strtotime($_REQUEST['date']));
            // $emp_contract_check = $employee->check_employee_contract($slot_det['employee'],$_REQUEST['date'],$employee_work_hours);
            $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($slot_det['employee'], $this_year_week, TRUE, $customer_to_add);
            $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
            if($check_flag !== TRUE){
                $return_obj['contract'] = 'fail';
                $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_det['employee'], $_REQUEST['date'], $error_array);
            }
        }
    } else {        //action == 'add_emp'
        $slot_det = $employee->customer_employee_slot_details($_REQUEST['id']);
        $customer_to_add = $slot_det['customer'] != '' ? trim($slot_det['customer']) : NULL;
        if($_REQUEST['emp_alloc'] != '' && $customer_to_add != ''){
            $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($_REQUEST['emp_alloc'], $_REQUEST['date'],$_REQUEST['id'], array(), array(), $customer_to_add, FALSE, TRUE);
            $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

            // $emp_contract_check = $employee->check_employee_contract($_REQUEST['emp_alloc'],$_REQUEST['date'],$employee_work_hours);
            $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($_REQUEST['emp_alloc'], $this_year_week, TRUE, $customer_to_add);
            $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
            if($check_flag !== TRUE){
                $return_obj['contract'] = 'fail';
                $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                $return_obj['contract_params'] = make_contract_fail_array($employee, $_REQUEST['emp_alloc'], $_REQUEST['date'], $error_array);
            }
        }
    }
}

/**
* @author: Shamsudheen <shamsu@arioninfotech.com>
* type_check: 8 
* for: 'past-select' timeslot(s) operation
*/
else if($_REQUEST['type_check'] == 8){
    require_once('class/dona.php');
    $obj_dona = new dona();
    
    //$slot_ids = $_SESSION['copy_slot'];
    $slot_ids = explode(",", $obj_user->retrieve_from_temp_session(1));
    $slots = "";
    $i = 0;
    if(!empty($slot_ids)){
        $slots = implode(',', $slot_ids);
        
        $slot_dets = $obj_dona->customer_employee_multi_slot_details($slots, 1);
        $slots_array_of_employees = array();
        if(!empty($slot_dets)){
            foreach($slot_dets as $slot_det){
                if($slot_det['customer'] == '' || $slot_det['employee'] == '') 
                    continue;
               // $slots_array_of_employees[$slot_det['employee']]['ids'][] = $slot_det['id'];
                $slots_array_of_employees[$slot_det['employee']][$slot_det['customer']]['dates'][] = $slot_det['date'];
                $slots_array_of_employees[$slot_det['employee']][$slot_det['customer']]['additional'][] = array('time_from' => $slot_det['time_from'], 'time_to' => $slot_det['time_to'], 'type' => $slot_det['type']);
            }
        }
        if(!empty($slots_array_of_employees)){
            $error_flag = FALSE;
            foreach ($slots_array_of_employees as $this_employee => $customer_datas) {
                
                foreach ($customer_datas as $this_customer => $datas) {

                    $paste_date = '';
                    if($_REQUEST['to_single_day'] || $_REQUEST['action'] == 'paste'){
                        $paste_date = $_REQUEST['date'];
                        if($_REQUEST['date_select'] && $_REQUEST['date_select'] != '')
                            $paste_date = $_REQUEST['date_select'];
                    }else{
                        $paste_date = date('Y-m-d', strtotime(substr($_REQUEST['date'], 0,4)."W".substr($_REQUEST['date'], 5,2).date("N", strtotime($datas['dates'][0]))));
                    }
                    
                    if(!isset($datas['additional']) || empty($datas['additional']))
                        $datas['additional'] = array();
                   // $employee_work_hours = $employee->get_employee_total_working_hours_by_param($this_employee, $paste_date, $contract_checking_slots);
                    $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($this_employee, $paste_date, NULL, $datas['additional'], array(), $this_customer, FALSE, TRUE);
                    $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                    $this_year_week = date('o|W', strtotime($paste_date));
                    // $emp_contract_check = $employee->check_employee_contract($this_employee, $paste_date, $employee_work_hours);
                    $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($this_employee, $this_year_week, TRUE, $this_customer);
                    $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                    if($check_flag !== TRUE){
                        $error_flag = TRUE;
                        $return_obj['contract'] = 'fail';
                        $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                        $return_obj['contract_params'] = make_contract_fail_array($employee, $this_employee, $paste_date, $error_array);
                        break;
                    }
                }

                if($error_flag) break;
            }
        }
    }
        
}

/**
* @author: Shamsudheen <shamsu@arioninfotech.com>
* type_check: 9 
* for: contract check when edit duration triggers
*/
else if($_REQUEST['type_check'] == 9){
    $slot_det = $employee->customer_employee_slot_details($_REQUEST['id']);
    if($slot_det['customer'] != '' && $slot_det['employee'] != '' && ($slot_det['time_from'] < number_format($_REQUEST['time_from'], 2) || $slot_det['time_to'] < number_format($_REQUEST['time_to'], 2))) {
        
        $multiple_array = array(array('time_from' => $_REQUEST['time_from'], 'time_to' => $_REQUEST['time_to'], 'type' => $slot_det['type']));
        $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($slot_det['employee'], $slot_det['date'], NULL, $multiple_array, array($_REQUEST['id']), $slot_det['customer'], FALSE, TRUE);
        $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

        $this_year_week = date('o|W', strtotime($slot_det['date']));
        // $emp_contract_check = $employee->check_employee_contract($slot_det['employee'], $slot_det['date'], $employee_work_hours);
        $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($slot_det['employee'], $this_year_week, TRUE, $slot_det['customer']);
        $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
        if($check_flag !== TRUE){
            $return_obj['contract'] = 'fail';
            $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
            $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_det['employee'], $slot_det['date'], $error_array);
        }
    }
}

/**
* @author: Shamsudheen <shamsu@arioninfotech.com>
* type_check: 10
* for: contract check when type changes to personal meeting with meeting employees
*/
else if($_REQUEST['type_check'] == 10){
    require_once('class/dona.php');
    $obj_dona = new dona();
    
    $proposed_slot_type = $_REQUEST['type'];
    $personal_meeting_emps = isset($_REQUEST['personal_meeting_emps']) ? trim($_REQUEST['personal_meeting_emps']): '';
    $personal_meeting_employees = explode('||', $personal_meeting_emps);
    
    if($proposed_slot_type == 10 && count($personal_meeting_employees)> 0){
        

        $time_from = $obj_dona->time_to_sixty($_REQUEST['time_from']);
        $time_to = $obj_dona->time_to_sixty($_REQUEST['time_to']);
        if($time_to == 0) $time_to = 24;
        
        $slot_det = $employee->customer_employee_slot_details($_REQUEST['id']);
       // $slot_from = $_REQUEST['slot_from'];
       // $slot_to = $_REQUEST['slot_to'];
        
        $this_customer = ($slot_det['customer'] != '' ? $slot_det['customer'] : NULL);
        $this_year_week = date('o|W', strtotime($slot_det['date']));

        if($this_customer != NULL){
            $fail_flag = FALSE;
            foreach($personal_meeting_employees as $this_emp){
                if($this_emp == $slot_det['employee']){  //check is this current slot?
                    if($slot_det['customer'] != '' ) {
                        $multiple_array = array(array('time_from' => $time_from, 'time_to' => $time_to, 'type' => $slot_det['type']));
                        $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($this_emp, $slot_det['date'], NULL, $multiple_array, array($slot_det['id']), $slot_det['customer'], FALSE, TRUE);
                        $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                        // $emp_contract_check = $employee->check_employee_contract($this_emp, $slot_det['date'], $employee_work_hours);
                        $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($this_emp, $this_year_week, TRUE, $slot_det['customer']);
                        $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                        if($check_flag !== TRUE){
                            $fail_flag = TRUE;
                            $return_obj['contract'] = 'fail';
                            $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                            $return_obj['contract_params'] = make_contract_fail_array($employee, $this_emp, $slot_det['date'], $error_array);
                            break;
                        }
                    }
                } else {  //check is this not current slot?
                    $exist_slot = array();
                    
                    $tmp_exist_slot = $employee->get_intersect_slots($slot_det['date'], $time_from, $time_to, $this_emp);
                    if($slot_det['employee'] == '' && empty($tmp_exist_slot)){
                        $exist_slot = $employee->get_intersect_slots($slot_det['date'], $time_from, $time_to, NULL);
                        $slot_det['employee '] = $this_emp;
                    }else
                        $exist_slot = $tmp_exist_slot;
                    
                    if (!empty($exist_slot)) {
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
                            $get_alt_slots_for_processing = $obj_dona->get_PM_time_slots_for_atl_checking($exist_slot, $keyindex, $time_from, $time_to, $this_customer);
                            $atl_slots = $get_alt_slots_for_processing['atl_slots'];
                            $atl_exception_slot_ids = $get_alt_slots_for_processing['exception_slot_ids'];
                            if (!empty($atl_slots) && $atl_slots[0]['customer'] != '' && $atl_slots[0]['employee'] != ''){
                                $atl_slots = $atl_slots[0];
                                $multiple_array = array(array('time_from' => $time_from, 'time_to' => $time_to, 'type' => 10));
                                $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($atl_slots['employee'], $atl_slots['date'], NULL, $multiple_array, $atl_exception_slot_ids, $atl_slots[0]['customer'], FALSE, TRUE);
                                $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                                // $emp_contract_check = $employee->check_employee_contract($atl_slots['employee'], $atl_slots['date'], $employee_work_hours);
                                $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($atl_slots['employee'], $this_year_week, TRUE, $atl_slots[0]['customer']);
                                $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                                if($check_flag !== TRUE){
                                    $fail_flag = TRUE;
                                    $return_obj['contract'] = 'fail';
                                    $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                                    $return_obj['contract_params'] = make_contract_fail_array($employee, $atl_slots['employee'], $atl_slots['date'], $error_array);
                                    break;
                                }
                            }
                            if($this_exist_slot['customer'] != ''){
                                $atl_slots = $atl_slots[0];
                                $multiple_array = array(array('time_from' => $this_exist_slot['time_from'], 'time_to' => $this_exist_slot['time_to'], 'type' => 10));
                                $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($this_emp, $this_exist_slot['date'], NULL, $multiple_array, array(), $this_exist_slot['customer'], FALSE, TRUE);
                                $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                                // $emp_contract_check = $employee->check_employee_contract($this_emp, $this_exist_slot['date'], $employee_work_hours);
                                $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($this_emp, $this_year_week, TRUE, $this_exist_slot['customer']);
                                $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                                if($check_flag !== TRUE){
                                    $fail_flag = TRUE;
                                    $return_obj['contract'] = 'fail';
                                    $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                                    $return_obj['contract_params'] = make_contract_fail_array($employee, $this_emp, $this_exist_slot['date'], $error_array);
                                    break;
                                }
                            }
                        }
                    } else {
                        //else part is for creating new timeslot with new employee and slot credentials
                        $atl_slots = $atl_slots[0];
                        $multiple_array = array(array('time_from' => $time_from, 'time_to' => $time_to, 'type' => 10));
                        $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($this_emp, $slot_det['date'], NULL, $multiple_array, array(), $this_customer, FALSE, TRUE);
                        $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                        // $emp_contract_check = $employee->check_employee_contract($this_emp, $slot_det['date'], $employee_work_hours);
                        $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($this_emp, $this_year_week, TRUE, $this_customer);
                        $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                        if($check_flag !== TRUE){
                            $fail_flag = TRUE;
                            $return_obj['contract'] = 'fail';
                            $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                            $return_obj['contract_params'] = make_contract_fail_array($employee, $this_emp, $slot_det['date'], $error_array);
                            break;
                        }
                    }
                }
                if($fail_flag) break;
            }
        }
    }
}


/**
* @author: Shamsudheen <shamsu@arioninfotech.com>
* type_check: 11 
* for: 'schema copy' timeslot(s) operation from alloc-window
*/
else if($_REQUEST['type_check'] == 11){
    
    $i = 0;
    $days = explode('-', $_REQUEST['days']);
    array_pop($days);
   // $from_year = date('Y');
    $from_year = date('o', strtotime($_REQUEST['date']));
    $from_week = $_REQUEST['from_week'];
    $to_year = substr($_REQUEST['to_week'], 0, 4);
    $to_week = str_pad(substr($_REQUEST['to_week'],5,2), 2, '0', STR_PAD_LEFT);
    $temp_to_week = $to_week;
    $slot_dets = array();
    if($_REQUEST['to_single_slot'])
        $slot_dets[0] = $employee->customer_employee_slot_details($_REQUEST['id']);
    else    
        $slot_dets = $employee->timetable_customer_employee_slots_copiable_for_copy($_REQUEST['customer'], $_REQUEST['date'], $_REQUEST['employee']);
    
    $slots_array_of_employees = array();
    if(!empty($slot_dets)){
        foreach($slot_dets as $slot_det){
            if($slot_det['customer'] == '' || $slot_det['employee'] == '') 
                continue;
            $slots_array_of_employees[$slot_det['employee']][$slot_det['customer']][] = $slot_det;
        }
    }
    if(!empty($slots_array_of_employees)){
        $error_flag = FALSE;
        foreach($slots_array_of_employees as $this_employee => $employee_slots){

            foreach($employee_slots as $this_customer => $slot_dets){
                if($to_year > $from_year) $to_week = 52;
               // $paste_year = date('Y');
                $paste_year = $from_year;
                // $process_Ym = '';
                // $max_oncall_contract_hours_for_this_month = 0.00;
                // $oncall_work_hours_for_a_month = 0.00;
                for($i = $from_week; $i <= $to_week; $i++){

                    $paste_week = str_pad($i, 2,'0',STR_PAD_LEFT);
                    //calculate maximum available contract hours for a week
                    $paste_year_week = $paste_year.'|'.$paste_week;
                    $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($this_employee, $paste_year_week, TRUE, $this_customer);
                    
                    
                    //this total hours calculated only for normal week slot manipulation
                    $this_week_start_date = date('Y-m-d', strtotime($paste_year . 'W' . $paste_week . 1));
                    $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($this_employee, $this_week_start_date, array(), array(), array(), $this_customer, FALSE, TRUE);
                    $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));
                    
                    foreach ($days as $day) {
                        foreach($slot_dets as $slot_det){
                        
                            // $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.$day));
                            //check weekly normal work hours // $slot_det['type']
                            $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($slot_det['type'], $process_normal_slot_types_array) ? $employee->time_difference($slot_det['time_from'], $slot_det['time_to']) : ($employee->time_difference($slot_det['time_from'], $slot_det['time_to']) / 4));
                            
                        }
                    }


                    $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                    if($check_flag !== TRUE){
                        $error_flag = TRUE;
                        $return_obj['contract'] = 'fail';
                        $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $paste_year_week));
                        $return_obj['contract_params'] = make_contract_fail_array($employee, $this_employee, $this_week_start_date, $error_array);
                        break;
                    }
                            
                    if($to_year > $from_year && $i == 52){
                        $i=1;
                        $to_week = $temp_to_week;
                        $paste_year = substr($_REQUEST['to_week'],0,4);
                    }

                    // $i++;
                    $i += $_REQUEST['from_option'];

                }
                if($error_flag) break;
            }
            if($error_flag) break;
        }
    }
}

/**
* @author: Shamsudheen <shamsu@arioninfotech.com>
* type_check: 12 
* for: 'copy' timeslot(s) operation from process-main (gdschema_customer|gdschema_employee)
*/
else if($_REQUEST['type_check'] == 12){
    
    if($_REQUEST['with_user'] == 1){
        $copy_start_date = date('Y-m-d H:i:s', strtotime(substr($_REQUEST['cur_week'],0,4)."W".str_pad($_REQUEST['from_week'],2,'0',STR_PAD_LEFT).'1'));
        $copy_start_date_minus = date('Y-m-d H:i:s',strtotime($copy_start_date .' -1 day'));
        $copy_end_date = date('Y-m-d H:i:s', strtotime($copy_start_date_minus.' +'.str_pad($_REQUEST['no_of_weeks'],2,'0',STR_PAD_LEFT).' week'));
        $employees = explode('-', $_REQUEST['employees']);
        array_pop($employees);
        $days = explode('-', $_REQUEST['days']);
        array_pop($days);
        $slot_dets = $employee->get_copy_slots($copy_start_date, $copy_end_date, $employees, $days);
        $slots_array_of_employees = array();
        if(!empty($slot_dets)){
            foreach($slot_dets as $slot_det){
                if($slot_det['customer'] == '' || $slot_det['employee'] == '') continue;
               // $slots_array_of_employees[$slot_det['employee']][] = $slot_det;
                $slots_array_of_employees[$slot_det['employee']][$slot_det['customer']][date('o|W', strtotime($slot_det['date']))][] = $slot_det;
            }
        }
        
        if(!empty($slots_array_of_employees)){
            $paste_year = substr($_REQUEST['to_week'],0,4);
            $paste_week = str_pad(substr($_REQUEST['to_week'],5), 2,'0',STR_PAD_LEFT);
            $error_flag = FALSE;
            
            foreach($slots_array_of_employees as $this_employee => $employee_datas){
                foreach($employee_datas as $this_customer => $year_week_datas){
                    for($i = 1; $i <= $_REQUEST['no_of_times']; $i++){
                        foreach($year_week_datas as $slot_year_week => $slot_dets){
                            
                            $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.date("N", strtotime($slot_dets[0]['date']))));
                            $paste_date = date('Y-m-d', strtotime($paste_date . ' +'.(($i-1)*7).' days'));
                            
                            //calculate maximum available contract hours for a week
                            $paste_year_week = date('o|W', strtotime($paste_date));
                            $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($this_employee, $paste_year_week, TRUE, $this_customer);

                            //this total hours calculated only for normal week slot manipulation
                            $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($this_employee, $paste_date, array(), array(), array(), $this_customer, FALSE, TRUE);
                            $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));
                            
                            foreach($slot_dets as $slot_det){
                                //check weekly normal work hours
                                $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($slot_det['type'], $process_normal_slot_types_array) ? $employee->time_difference($slot_det['time_from'], $slot_det['time_to']) : ($employee->time_difference($slot_det['time_from'], $slot_det['time_to']) / 4));
                            }

                            $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                            if($check_flag !== TRUE){
                                $error_flag = TRUE;
                                $return_obj['contract'] = 'fail';
                                $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $paste_year_week));
                                $return_obj['contract_params'] = make_contract_fail_array($employee, $this_employee, $paste_date, $error_array);
                                break;
                            }
                        }
                        if($error_flag) break;
                    }
                    if($error_flag) break;
                }
                if($error_flag) break;
            }
        }
    }
}

/**
* @author: Shamsudheen <shamsu@arioninfotech.com>
* type_check: 13 
* for: 'schema multiple employee assignment' timeslot(s) operation from alloc_window
*/
else if($_REQUEST['type_check'] == 13){
    
    $sel_date = trim($_REQUEST['date']);
    $sel_employee_to_assign = trim($_REQUEST['empl']);
    $from_option = trim($_REQUEST['from_option']);

    $sel_ids = trim($_REQUEST['ids']);
    $sel_slots_array = explode(',', $sel_ids);
    if(!empty($sel_slots_array)){
        foreach($sel_slots_array as $key => $val){
            if(trim($val) == '') unset ($sel_slots_array[$key]);
        }
    }
    
    $i = 0;
    $days = explode('-', $_REQUEST['days']);
    array_pop($days);
    $from_year = date('o', strtotime($sel_date));
    $from_week = trim($_REQUEST['from_week']);
    $to_year = substr($_REQUEST['to_week'], 0, 4);
    $to_week = str_pad(substr($_REQUEST['to_week'],5,2), 2, '0', STR_PAD_LEFT);
    $temp_to_week = $to_week;
    
    $slot_dets = $employee->get_multiple_slot_details($sel_slots_array, $sel_date);
    $total_no_of_slots = count($slot_dets);
    $customer_slot_group = array();
    for($x = 0 ; $x < $total_no_of_slots; $x++){
        if($slot_dets[$x]['customer'] == '') 
            continue; // unset($slot_dets[$x]);
        else
            $slot_dets[$x]['employee'] = $sel_employee_to_assign;

        $customer_slot_group[$slot_dets[$x]['customer']][] = $slot_dets[$x];
    }
    // $slot_dets = array_values($slot_dets);
    

    if(!empty($customer_slot_group)){
        foreach ($customer_slot_group as $this_customer => $customer_slots) {
            if($to_year > $from_year) $to_week = 52;
            $paste_year = $from_year;
            $error_flag = FALSE;
            $process_Ym = '';
            $max_oncall_contract_hours_for_this_month = 0.00;
            $oncall_work_hours_for_a_month = 0.00;
            for($i = $from_week; $i <= $to_week; $i++){
                $empl_contract_check_time = 0;
                $paste_week = str_pad($i, 2,'0',STR_PAD_LEFT);
                
                //calculate maximum available contract hours for a week
                $paste_year_week = $paste_year.'|'.$paste_week;
                $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($sel_employee_to_assign, $paste_year_week, TRUE, $this_customer);
                
                //this total hours calculated only for normal week slot manipulation
                $this_week_start_date = date('Y-m-d', strtotime($paste_year . 'W' . $paste_week . 1));
                $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($sel_employee_to_assign, $this_week_start_date, array(), array(), array(), $this_customer, FALSE, TRUE);
                $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                foreach ($days as $day) {
                    foreach($customer_slots as $slot_det){

                        // $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.$day));
                        $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($slot_det['type'], $process_normal_slot_types_array) ? $employee->time_difference($slot_det['time_from'], $slot_det['time_to']) : ($employee->time_difference($slot_det['time_from'], $slot_det['time_to']) / 4));
                    }
                }

                $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                if($check_flag !== TRUE){
                    $error_flag = TRUE;
                    $return_obj['contract'] = 'fail';
                    $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $paste_year_week));
                    $return_obj['contract_params'] = make_contract_fail_array($employee, $sel_employee_to_assign, $this_week_start_date, $error_array);
                    break;
                }

                        
                if($to_year > $from_year && $i == 52){
                    $i=1;
                    $to_week = $temp_to_week;
                    $paste_year = substr($_REQUEST['to_week'],0,4);
                }

                // $i++;
                $i += $from_option;
            }
        }
    }
}

/**
* @author: Shamsudheen <shamsu@arioninfotech.com>
* type_check: 14 
* for: 'schema drag-n-drop | schema manual entry' timeslot(s) operation from alloc_window
*/
else if($_REQUEST['type_check'] == 14){
    //needs slot type
    $sel_date = trim($_REQUEST['date']);
    $from_option = trim($_REQUEST['from_option']);
    $days = explode('-', $_REQUEST['days']);
    array_pop($days);
    $from_year = date('o', strtotime($sel_date));
    $from_week = trim($_REQUEST['from_week']);
    $to_year = substr($_REQUEST['to_week'], 0, 4);
    $to_week = str_pad(substr($_REQUEST['to_week'],5,2), 2, '0', STR_PAD_LEFT);
    $temp_to_week = $to_week;
    
    if($_REQUEST['sub_action'] == 'multiple_add' && isset($_REQUEST['from_week']) && isset($_REQUEST['to_week']) && trim($_REQUEST['from_week']) != '' && trim($_REQUEST['to_week']) != ''){
        require_once('class/dona.php');
        $obj_dona = new dona();

        $customer_to_add = trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
        if ($_SESSION['user_role'] == 4)  $customer_to_add = $_SESSION['user_id'];
        
        $employee_to_add = trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
        if ($_SESSION['user_role'] == 3)  $employee_to_add = $_SESSION['user_id'];
        
        $selected_date = trim($_REQUEST['date']);
        $slot_periods = array();
        
        if(!empty($_REQUEST['time_slots'])){
            $next_date = date('Y-m-d', strtotime($selected_date .' +1 day'));
            foreach($_REQUEST['time_slots'] as $time_slot){

                $tmp_time_from  = $obj_dona->time_to_sixty(trim($time_slot['time_from']));
                $tmp_time_to    = $obj_dona->time_to_sixty(trim($time_slot['time_to']));
                if($tmp_time_to == 0) $tmp_time_to = 24;
                
                $tmp_emp_to_add =  $employee_to_add != NULL ? $employee_to_add : trim($time_slot['employee']);

                if($tmp_time_from != false && $tmp_time_to != false && $customer_to_add != '' && $tmp_emp_to_add != ''){
                    $slot_periods[$tmp_emp_to_add][$customer_to_add][] = array( 
                            'date'      => $selected_date,
                            'time_from' => $tmp_time_from, 
                            'time_to'   => $tmp_time_to, 
                            'customer'  => $customer_to_add,
                            'employee'  => $tmp_emp_to_add,
                            'type'      => trim($time_slot['type']) 
                        );
                }
            }
        }
        
        $global_failed = false;
        $error_flag = FALSE;
        if(!empty($slot_periods)){
            foreach($slot_periods as $slot_emp => $slot_emp_periods){
                foreach($slot_emp_periods as $slot_cust => $slot_cust_periods){
                    
                    // $process_Ym = array();
                    foreach($slot_cust_periods as $slot_det){
                        if($to_year > $from_year) $to_week = 52;
                        $paste_year = $from_year;
                        $carriage_slot = array();    //for $time_from >= $time_to and the carriage slot of last day extends to next week
                        
                        for($i = $from_week; $i <= $to_week; $i++){
                            $paste_week = str_pad($i, 2,'0',STR_PAD_LEFT);

                            //calculate maximum available contract hours for a week
                            $paste_year_week = $paste_year.'|'.$paste_week;
                            $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($slot_det['employee'], $paste_year_week, TRUE, $slot_cust);

                            //this total hours calculated only for normal week slot manipulation
                            $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.'1'));
                            $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($slot_det['employee'], $paste_date, array(), array(), array(), $slot_cust, FALSE, TRUE);
                            $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                            $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                            if($check_flag !== TRUE){
                                $error_flag = TRUE;
                                $return_obj['contract'] = 'fail';
                                $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $paste_year_week));
                                $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_det['employee'], $paste_date, $error_array);
                                break;
                            }


                            if ($slot_det['time_from'] >= $slot_det['time_to']) {
                                if(isset($carriage_slot[$paste_year_week]) && !empty($carriage_slot[$paste_year_week])){
                                    
                                    $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($carriage_slot[$paste_year_week]['type'], $process_normal_slot_types_array) ? $employee->time_difference($carriage_slot[$paste_year_week]['time_from'], $carriage_slot[$paste_year_week]['time_to']) : ($employee->time_difference($carriage_slot[$paste_year_week]['time_from'], $carriage_slot[$paste_year_week]['time_to']) / 4));
                                    unset($carriage_slot[$paste_year_week]);
                                    $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                                    if($check_flag !== TRUE){
                                        $error_flag = TRUE;
                                        $return_obj['contract'] = 'fail';
                                        $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $paste_year_week));
                                        $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_det['employee'], $paste_date, $error_array);
                                        break;
                                    }
                                }
                            }

                            foreach ($days as $day) {

                                $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.$day));
                                //check weekly normal hours
                                if ($slot_det['time_from'] >= $slot_det['time_to']) {
                                    $nextday_year_week = date('o|W', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
                                    if($paste_year_week == $nextday_year_week){
                                        $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($slot_det['type'], $process_normal_slot_types_array) ? $employee->time_difference($slot_det['time_from'], 24) : ($employee->time_difference($slot_det['time_from'], 24) / 4));
                                        $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($slot_det['type'], $process_normal_slot_types_array) ? $employee->time_difference(0, $slot_det['time_to']) : ($employee->time_difference(0, $slot_det['time_to']) / 4));
                                    } else {
                                        $carriage_slot[$nextday_year_week] = array('time_from' => 0, 'time_to' => $slot_det['time_to']);
                                        $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($slot_det['type'], $process_normal_slot_types_array) ? $employee->time_difference($slot_det['time_from'], 24) : ($employee->time_difference($slot_det['time_from'], 24) / 4));
                                    }
                                }else{
                                    $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($slot_det['type'], $process_normal_slot_types_array) ? $employee->time_difference($slot_det['time_from'], $slot_det['time_to']) : ($employee->time_difference($slot_det['time_from'], $slot_det['time_to']) / 4));
                                }

                                $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                                if($check_flag !== TRUE){
                                    $error_flag = TRUE;
                                    $return_obj['contract'] = 'fail';
                                    $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $paste_year_week));
                                    $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_det['employee'], $paste_date, $error_array);
                                    break;
                                }

                                if($to_year > $from_year && $i == 52){
                                    $i=1;
                                    $to_week = $temp_to_week;
                                    $paste_year = substr($_REQUEST['to_week'],0,4);
                                }
                                $i++;
                                $i += $from_option;
                            }
                            if($error_flag) break;
                        }
                        if(!$error_flag && !empty($carriage_slot)){
                            foreach($carriage_slot as $paste_year_week => $paste_year_week_data){
                                $this_year_week_array = explode('|', $paste_year_week);
                                $paste_year = $this_year_week_array[0];
                                $paste_week = str_pad($this_year_week_array[1], 2,'0',STR_PAD_LEFT);
                                $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($slot_det['employee'], $paste_year_week, TRUE, $slot_cust);

                                //this total hours calculated only for normal week slot manipulation
                                $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.'1'));
                                $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($slot_det['employee'], $paste_date, array(), array(), array(), $slot_cust, FALSE, TRUE);
                                $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                                //check weekly normal hours
                                $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($paste_year_week_data['type'], $process_normal_slot_types_array) ? $employee->time_difference($paste_year_week_data['time_from'], $paste_year_week_data['time_to']) : ($employee->time_difference($paste_year_week_data['time_from'], $paste_year_week_data['time_to']) / 4));
                                $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                                if($check_flag !== TRUE){
                                    $error_flag = TRUE;
                                    $return_obj['contract'] = 'fail';
                                    $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $paste_year_week));
                                    $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_det['employee'], $paste_date, $error_array);
                                    break;
                                }

                            }
                        }
                    }
                    if($error_flag) break;
                }
                if($error_flag) break;
            }
        }
    }
    
    else {
    
        $__slot_employee = trim($_REQUEST['employee']);
        $__slot_customer = trim($_REQUEST['customer']);
        $time_from = trim($_REQUEST['time_from']);
        $time_to = trim($_REQUEST['time_to']);
        $slot_type = trim($_REQUEST['slotType']);   //memslottype
        $i = 0;

        if($__slot_employee != '' && $__slot_customer != ''){
            if($to_year > $from_year) $to_week = 52;
            $paste_year = $from_year;
            $error_flag = FALSE;
            // $process_Ym = array();
            $max_oncall_contract_hours_for_this_month = 0.00;
            $oncall_work_hours_for_a_month = 0.00;
            $carriage_slot = array();    //for $time_from >= $time_to and the carriage slot of last day extends to next week
            for($i = $from_week; $i <= $to_week; $i++){
                $paste_week = str_pad($i, 2,'0',STR_PAD_LEFT);

                //calculate maximum available contract hours for a week
                $paste_year_week = $paste_year.'|'.$paste_week;
                $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($__slot_employee, $paste_year_week, TRUE, $__slot_customer);

                //this total hours calculated only for normal week slot manipulation
                $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.'1'));
                $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($__slot_employee, $paste_date, array(), array(), array(), $__slot_customer, FALSE, TRUE);
                $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                if($check_flag !== TRUE){
                    $error_flag = TRUE;
                    $return_obj['contract'] = 'fail';
                    $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $paste_year_week));
                    $return_obj['contract_params'] = make_contract_fail_array($employee, $__slot_employee, $paste_date, $error_array);
                    break;
                }


                if ($time_from >= $time_to) {
                    if(isset($carriage_slot[$paste_year_week]) && !empty($carriage_slot[$paste_year_week])){
                        //check weekly normal hours
                        $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($carriage_slot[$paste_year_week]['type'], $process_normal_slot_types_array) ? $employee->time_difference($carriage_slot[$paste_year_week]['time_from'], $carriage_slot[$paste_year_week]['time_to']) : ($employee->time_difference($carriage_slot[$paste_year_week]['time_from'], $carriage_slot[$paste_year_week]['time_to']) / 4));
                        unset($carriage_slot[$paste_year_week]);
                        $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                        if($check_flag !== TRUE){
                            $error_flag = TRUE;
                            $return_obj['contract'] = 'fail';
                            $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $paste_year_week));
                            $return_obj['contract_params'] = make_contract_fail_array($employee, $__slot_employee, $paste_date, $error_array);
                            break;
                        }
                    }
                }

                foreach ($days as $day) {

                    $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.$day));
                    //check weekly normal hours
                    if ($time_from >= $time_to) {
                        $nextday_year_week = date('o|W', strtotime(date('Y-m-d', strtotime($paste_date)) . ' +1 day'));
                        if($paste_year_week == $nextday_year_week){
                            $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($slot_type, $process_normal_slot_types_array) ? $employee->time_difference($time_from, 24) : ($employee->time_difference($time_from, 24) / 4));
                            $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($slot_type, $process_normal_slot_types_array) ? $employee->time_difference(0, $time_to) : ($employee->time_difference(0, $time_to) / 4));
                        } else {
                            $carriage_slot[$nextday_year_week] = array('time_from' => 0, 'time_to' => $time_to);
                            $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($slot_type, $process_normal_slot_types_array) ? $employee->time_difference($time_from, 24) : ($employee->time_difference($time_from, 24) / 4));
                        }
                    }else{
                        $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($slot_type, $process_normal_slot_types_array) ? $employee->time_difference($time_from, $time_to) : ($employee->time_difference($time_from, $time_to) / 4));
                    }

                    $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                    if($check_flag !== TRUE){
                        $error_flag = TRUE;
                        $return_obj['contract'] = 'fail';
                        $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $paste_year_week));
                        $return_obj['contract_params'] = make_contract_fail_array($employee, $__slot_employee, $paste_date, $error_array);
                        break;
                    }

                    if($to_year > $from_year && $i == 52){
                        $i=1;
                        $to_week = $temp_to_week;
                        $paste_year = substr($_REQUEST['to_week'],0,4);
                    }
                    $i++;
                    $i += $from_option;
                }
                if($error_flag) break;
            }

            if(!$error_flag && !empty($carriage_slot)){
                foreach($carriage_slot as $paste_year_week){
                    $this_year_week_array = explode('|', $paste_year_week);
                    $paste_year = $this_year_week_array[0];
                    $paste_week = str_pad($this_year_week_array[1], 2,'0',STR_PAD_LEFT);
                    $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($__slot_employee, $paste_year_week, TRUE, $__slot_customer);

                    //this total hours calculated only for normal week slot manipulation
                    $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.'1'));
                    $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($__slot_employee, $paste_date, array(), array(), array(), $__slot_customer, FALSE, TRUE);
                    $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                    //check weekly normal hours
                    $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($paste_year_week['type'], $process_normal_slot_types_array) ? $employee->time_difference($paste_year_week['time_from'], $paste_year_week['time_to']) : ($employee->time_difference($paste_year_week['time_from'], $paste_year_week['time_to']) / 4));
                    $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                    if($check_flag !== TRUE){
                        $error_flag = TRUE;
                        $return_obj['contract'] = 'fail';
                        $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $paste_year_week));
                        $return_obj['contract_params'] = make_contract_fail_array($employee, $__slot_employee, $paste_date, $error_array);
                        break;
                    }

                }
            }
        }
    }
}


/**
* @author: Shamsudheen <shamsu@arioninfotech.com>
* type_check: 15
* for: 'swap' timeslot(s) operation <slot-manage>
*/
else if($_REQUEST['type_check'] == 15){
    
    if(isset($_SESSION['swap']) && isset($_REQUEST['id'])){
        $slot_det1 = $employee->customer_employee_slot_details($_SESSION['swap']);
        $slot_det2 = $employee->customer_employee_slot_details($_REQUEST['id']);
        
        if(!empty($slot_det1) && !empty($slot_det2)){
            $error_flag = FALSE;
            //source slot
            if($slot_det1['customer'] != '' && $slot_det1['employee'] != ''){
                $updating_records = array(array('time_from' => $slot_det1['time_from'], 'time_to' => $slot_det1['time_to'], 'type' => $slot_det1['type']));
                $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($slot_det1['employee'], $slot_det2['date'], array(), $updating_records, array($slot_det1['id'], $slot_det2['id']), $slot_det1['customer'], FALSE, TRUE);
                $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                $this_year_week = date('o|W', strtotime($slot_det2['date']));
                // $emp_contract_check1 = $employee->check_employee_contract($slot_det1['employee'],$slot_det2['date'],$employee_work_hours);
                $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($slot_det1['employee'], $this_year_week, TRUE, $slot_det1['customer']);
                $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                if($check_flag !== TRUE){
                    $error_flag = TRUE;
                    $return_obj['contract'] = 'fail';
                    $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                    $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_det1['employee'], $slot_det2['date'], $error_array);
                }
            }
            
            //target slot
           // if($slot_det2['customer'] != '' && $slot_det2['employee'] != '' && !$error_flag){
            if($slot_det2['customer'] != '' && $slot_det2['employee'] != ''){
                $updating_records = array(array('time_from' => $slot_det2['time_from'], 'time_to' => $slot_det2['time_to'], 'type' => $slot_det2['type']));
                $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($slot_det2['employee'], $slot_det1['date'], array(), $updating_records, array($slot_det1['id'], $slot_det2['id']), $slot_det2['customer'], FALSE, TRUE);
                $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                $this_year_week = date('o|W', strtotime($slot_det1['date']));
                // $emp_contract_check2 = $employee->check_employee_contract($slot_det2['employee'],$slot_det1['date'],$employee_work_hours);
                $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($slot_det2['employee'], $this_year_week, TRUE, $slot_det2['customer']);
                $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                if ($check_flag !== TRUE){
                    $return_obj['contract'] = 'fail';
                    $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                    $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_det2['employee'], $slot_det1['date'], $emp_contract_check2, $error_array);
                }
            }
        }
    }
}


/**
* @author: Shamsudheen <shamsu@arioninfotech.com>
* type_check: 16
* for: 'save schedule template'  <use_template_schedule.tpl>
*/
else if($_REQUEST['type_check'] == 16){
    
    $year_week_grouped_posted_data = array();
    if(!empty($_REQUEST['postdata'])){
        foreach($_REQUEST['postdata'] as $postdata){
            if($postdata != ''){
                $data_values = explode(",",$postdata);
                if($data_values[0] != '' && $data_values[1] != ''){
                    $year_week_grouped_posted_data[$data_values[0]][date('o|W', strtotime($data_values[2]))][$data_values[1]][] = $postdata;
                }
            }
        }
    }
    
   // echo "<pre>".print_r($year_week_grouped_posted_data, 1)."</pre>";
   // echo "<pre>".print_r($previous_slot_schedules_ids, 1)."</pre>";
    $employee_contract_failed_data = array();
    if(!empty($year_week_grouped_posted_data)){
        $error_flag = FALSE;
        foreach($year_week_grouped_posted_data as $this_employee => $year_week_datas){
            // $process_Ym = '';
            // $max_oncall_contract_hours_for_this_month = 0.00;
            // $oncall_work_hours_for_a_month = 0.00;
            foreach($year_week_datas as $slot_year_week => $slot_dets_week){

                foreach($slot_dets_week as $slot_customer => $postdatas){

                    $first_data_values = explode(",",$postdatas[0]);
                    // $paste_year_week = date('o|W', strtotime($first_data_values[2]));
                    $paste_year_week = $slot_year_week;
                    $updating_records = array();

                    foreach($postdatas as $slot_index => $slot_det){
                        $temp_data_values = explode(",", $slot_det);
                        $updating_records[] = array('time_from' => $temp_data_values[3], 'time_to' => $temp_data_values[4], 'type' => $temp_data_values[5]);
                    }

                    $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($this_employee, $first_data_values[2], array(), $updating_records, array(), $slot_customer, FALSE, TRUE);
                    $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                    $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($this_employee, $slot_year_week, TRUE, $slot_customer);
                    $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                    if($check_flag !== TRUE){
                        $error_flag = TRUE;
                        $return_obj['contract'] = 'fail';
                        $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $slot_year_week));
                        $return_obj['contract_params'] = make_contract_fail_array($employee, $this_employee, $first_data_values[2], $error_array);
                        break;
                    }
                }


                if($error_flag) break;
            }
            if($error_flag) break;
        }
    }
}

/**
* @author: Shamsudheen <shamsu@arioninfotech.com>
* type_check: 17
* for: 'change employee/customer of multiple slots '
* @request-from: right-click events from gdschema_employee/gdschema_customer
*/
else if($_REQUEST['type_check'] == 17){
    
    $ids = explode("-",$_REQUEST['ids']);
    $slot_dets = $employee->get_multiple_slot_details($ids);
    
    $employee_grouped_data = array();
    if(!empty($slot_dets)){
        foreach($slot_dets as $slot_det){
            $override_employee = (isset($_REQUEST['employee_username']) && trim($_REQUEST['employee_username']) != '' ? trim($_REQUEST['employee_username']) : $slot_det['employee']);
            $override_customer = (isset($_REQUEST['customer_select']) && trim($_REQUEST['customer_select']) != '' ? trim($_REQUEST['customer_select']) : $slot_det['customer']);
            
            if($override_employee == '' || $override_customer == '') continue;
            $employee_grouped_data[$override_employee][date('o|W', strtotime($slot_det['date']))][$override_customer][] = array(
                            'id'            =>  $slot_det['id'], 
                            'employee'      =>  $override_employee,
                            'customer'      =>  $override_customer, 
                            'date'          =>  $slot_det['date'], 
                            'time_from'     =>  $slot_det['time_from'], 
                            'time_to'       =>  $slot_det['time_to'], 
                            'type'          =>  $slot_det['type'], 
                            'status'        =>  $slot_det['status'], 
                            'alloc_emp'     =>  $slot_det['alloc_emp'], 
                            'relation_id'   =>  $slot_det['relation_id'],
                            'fkkn'          =>  $slot_det['fkkn']);
        }
    }
   // echo "<pre>".print_r($employee_grouped_data, 1)."</pre>";
    $employee_contract_failed_data = array();
    if(!empty($employee_grouped_data)){
        $error_flag = FALSE;
        foreach($employee_grouped_data as $this_employee => $year_week_datas){
            foreach($year_week_datas as $slot_year_week => $slot_dets_week){
                $first_data_date = $slot_dets_week[0]['date'];
                foreach($slot_dets_week as $slot_customer => $slot_dets){

                    $process_ids = array();
                    $updating_records = array();

                    foreach($slot_dets as $slot_index => $slot_det){
                        $process_ids[] = $slot_det['id'];
                        $updating_records[] = array('time_from' => $slot_det['time_from'], 'time_to' => $slot_det['time_to'], 'type' => $slot_det['type']);
                    }

                    $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($this_employee, $first_data_date, array(), $updating_records, $process_ids, $slot_customer, FALSE, TRUE);
                    $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                    $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($this_employee, $slot_year_week, TRUE, $slot_customer);
                    // $emp_contract_check = $employee->check_employee_contract($this_employee, $first_data_date, $employee_work_hours);
                    $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                    if($check_flag !== TRUE){
                        $error_flag = TRUE;
                        $return_obj['contract'] = 'fail';
                        $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $slot_year_week));
                        $return_obj['contract_params'] = make_contract_fail_array($employee, $this_employee, $first_data_date, $error_array);
                        break;
                    }
                }

                if($error_flag) break;

            }
            if($error_flag) break;
        }
    } 
}

/**
* @author: Shamsudheen <shamsu@arioninfotech.com>
* type_check: 18
* for: manual entry slot
* @request-from: gdschema_alloc_window
*/

else if($_REQUEST['type_check'] == 18){
    // need request updation
    
    // echo "<pre>".print_r($_REQUEST, 1)."</pre>";
    if (isset($_REQUEST['sub_action']) && $_REQUEST['sub_action'] == 'multiple_add') {
        
        require_once('class/dona.php');
        $obj_dona = new dona();

        $customer_to_add = trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
        if ($_SESSION['user_role'] == 4)  $customer_to_add = $_SESSION['user_id'];
        
        $employee_to_add = trim($_REQUEST['employee']) != '' ? trim($_REQUEST['employee']) : NULL;
        if ($_SESSION['user_role'] == 3)  $employee_to_add = $_SESSION['user_id'];
        
        $paste_date = $selected_date = trim($_REQUEST['date']);
        $slot_periods = array();
        
        if(!empty($_REQUEST['time_slots'])){
            $next_date = date('Y-m-d', strtotime($selected_date .' +1 day'));
            foreach($_REQUEST['time_slots'] as $time_slot){

                $tmp_time_from  = $obj_dona->time_to_sixty(trim($time_slot['time_from']));
                $tmp_time_to    = $obj_dona->time_to_sixty(trim($time_slot['time_to']));
                if($tmp_time_to == 0) $tmp_time_to = 24;
                
                $tmp_emp_to_add =  $employee_to_add != NULL ? $employee_to_add : trim($time_slot['employee']);

                if($tmp_time_from != false && $tmp_time_to != false && $customer_to_add != '' && $tmp_emp_to_add != ''){
                    $slot_periods[$tmp_emp_to_add][] = array( 
                            'date'      => $selected_date,
                            'time_from' => $tmp_time_from, 
                            'time_to'   => $tmp_time_to, 
                            'customer'  => $customer_to_add,
                            'employee'  => $tmp_emp_to_add,
                            'type'      => trim($time_slot['type']) 
                        );
                }
            }
        }
        
       // echo "slot_periods<pre>".print_r($slot_periods, 1)."</pre>";
        $global_failed = false;
        $error_flag = FALSE;
        if(!empty($slot_periods)){
            $emp_cust_fetched_contracts = array();
            foreach($slot_periods as $slot_emp => $slot_emp_periods){
                
                $process_Ym = array();
                $carriage_slot = array();    //for $time_from >= $time_to and the carriage slot of last day extends to next week
                
                $next_date = date('Y-m-d', strtotime($selected_date .' +1 day'));
                $this_year_week = date('o|W', strtotime($selected_date));
                $nextday_year_week = date('o|W', strtotime($next_date));

                /*
                //calculate maximum available contract hours for a week
                $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($slot_emp, $this_year_week, TRUE, $slot_emp_periods['customer']);

                $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($slot_emp, $selected_date);
                echo "max_contract_hours_for_a_week<pre>".print_r($max_contract_hours_for_a_week, 1)."</pre>";
                $normal_work_hours_for_a_week = $this_day_employee_hours['weekly_normal'];
                        
                $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                if($check_flag !== TRUE){
                    $error_flag = TRUE;
                    $return_obj['contract'] = 'fail';
                    $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                    $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_det['employee'], $selected_date, $error_array);
                    break;
                }*/

                // $test = explode('.', sprintf('%.02f', '10.05'));
                // echo "<pre>".print_r($test, 1)."<pre>";

                $re_arranged_customer_sums = array();

                foreach($slot_emp_periods as $slot_det){

                    //calculate maximum available contract hours for a week
                    if(!isset($re_arranged_customer_sums[$slot_det['customer']][$this_year_week]['contract_sum'])){
                        $re_arranged_customer_sums[$slot_det['customer']][$this_year_week]['contract_sum'] = $employee->employee_contract_week_hour($slot_emp, $this_year_week, TRUE, $slot_det['customer']);
                    }
                    // $max_contract_hours_for_a_week = $re_arranged_customer_sums[$slot_det['customer']][$this_year_week]['contract_sum'];

                    if(!isset($re_arranged_customer_sums[$slot_det['customer']][$this_year_week]['working_sum'])){
                        $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($slot_emp, $selected_date, array(), array(), array(), $slot_det['customer'], FALSE, TRUE);
                        // echo "<pre>".print_r($this_day_employee_hours, 1)."<pre>";
                        $re_arranged_customer_sums[$slot_det['customer']][$this_year_week]['working_sum'] = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));
                    }

                    if ($slot_det['time_from'] >= $slot_det['time_to']) {
                        $nextday_year_week = date('o|W', strtotime(date('Y-m-d', strtotime($selected_date)) . ' +1 day'));
                        if($this_year_week == $nextday_year_week){
                            $re_arranged_customer_sums[$slot_det['customer']][$this_year_week]['working_sum'] = $employee->time_sum($re_arranged_customer_sums[$slot_det['customer']][$this_year_week]['working_sum'], in_array($slot_det['type'], $process_normal_slot_types_array) ? $employee->time_difference($slot_det['time_from'], 24) : ($employee->time_difference($slot_det['time_from'], 24) / 4));
                            $re_arranged_customer_sums[$slot_det['customer']][$this_year_week]['working_sum'] = $employee->time_sum($re_arranged_customer_sums[$slot_det['customer']][$this_year_week]['working_sum'], in_array($slot_det['type'], $process_normal_slot_types_array) ? $employee->time_difference(0, $slot_det['time_to']) : ($employee->time_difference(0, $slot_det['time_to']) / 4));
                        } else {

                            if(!isset($re_arranged_customer_sums[$slot_det['customer']][$nextday_year_week]['contract_sum'])){
                                $re_arranged_customer_sums[$slot_det['customer']][$nextday_year_week]['contract_sum'] = $employee->employee_contract_week_hour($slot_emp, $nextday_year_week, TRUE, $slot_det['customer']);
                            }

                            // $carriage_slot[] = array('date' => $next_date, 'time_from' => 0, 'time_to' => $slot_det['time_to'], 'type' => $slot_det['type']);
                            $re_arranged_customer_sums[$slot_det['customer']][$this_year_week]['working_sum'] = $employee->time_sum($re_arranged_customer_sums[$slot_det['customer']][$this_year_week]['working_sum'], in_array($slot_det['type'], $process_normal_slot_types_array) ? $employee->time_difference($slot_det['time_from'], 24) : ($employee->time_difference($slot_det['time_from'], 24) / 4));

                            if(!isset($re_arranged_customer_sums[$slot_det['customer']][$nextday_year_week]['working_sum'])){
                                $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($slot_emp, $next_date, array(), array(), array(), $slot_det['customer'], FALSE, TRUE);
                                $re_arranged_customer_sums[$slot_det['customer']][$nextday_year_week]['working_sum'] = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));
                            }
                            $re_arranged_customer_sums[$slot_det['customer']][$nextday_year_week]['working_sum'] = $employee->time_sum($re_arranged_customer_sums[$slot_det['customer']][$nextday_year_week]['working_sum'], in_array($slot_det['type'], $process_normal_slot_types_array) ? $employee->time_difference(0, $slot_det['time_to']) : ($employee->time_difference(0, $slot_det['time_to']) / 4));
                        }
                    }else
                        $re_arranged_customer_sums[$slot_det['customer']][$this_year_week]['working_sum'] = $employee->time_sum($re_arranged_customer_sums[$slot_det['customer']][$this_year_week]['working_sum'], in_array($slot_det['type'], $process_normal_slot_types_array) ? $employee->time_difference($slot_det['time_from'], $slot_det['time_to']) : ($employee->time_difference($slot_det['time_from'], $slot_det['time_to']) / 4));
                }

                // echo 're_arranged_customer_sums<pre>'.print_r($re_arranged_customer_sums, 1).'</pre>';
                        
                if(!empty($re_arranged_customer_sums)){
                    foreach($re_arranged_customer_sums as $this_cust => $splited_customer_data){
                        foreach($splited_customer_data as $this_week => $week_data){
                            $check_flag = ($week_data['working_sum'] > $week_data['contract_sum'])? FALSE : TRUE;
                            if($check_flag !== TRUE){
                                $error_flag = TRUE;
                                $return_obj['contract'] = 'fail';
                                $error_array = array('normal' => array('work_hours' => $week_data['working_sum'], 'contract_hours' => $week_data['contract_sum'], 'year_week' => $this_week));
                                $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_emp, $selected_date, $error_array);
                                break;
                            }
                        }
                        if($error_flag) break;
                    }

                }

                /*foreach($slot_emp_periods as $slot_det){


                    //calculate maximum available contract hours for a week
                    if(!isset($emp_cust_fetched_contracts[$slot_emp][$slot_det['customer']][$this_year_week])){
                        $emp_cust_fetched_contracts[$slot_emp][$slot_det['customer']][$this_year_week] = $employee->employee_contract_week_hour($slot_emp, $this_year_week, TRUE, $slot_det['customer']);
                    }
                    $max_contract_hours_for_a_week = $emp_cust_fetched_contracts[$slot_emp][$slot_det['customer']][$this_year_week];

                    //check weekly normal hours
                    if(in_array($slot_det['type'], $process_normal_slot_types_array)){
                        if ($slot_det['time_from'] >= $slot_det['time_to']) {
                            $nextday_year_week = date('o|W', strtotime(date('Y-m-d', strtotime($selected_date)) . ' +1 day'));
                            if($this_year_week == $nextday_year_week){
                                $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, $employee->time_difference($slot_det['time_from'], 24));
                                $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, $employee->time_difference(0, $slot_det['time_to']));
                            } else {
                                $carriage_slot[] = array('date' => $next_date, 'time_from' => 0, 'time_to' => $slot_det['time_to'], 'type' => $slot_det['type']);
                                $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, $employee->time_difference($slot_det['time_from'], 24));
                            }
                        }else
                            $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, $employee->time_difference($slot_det['time_from'], $slot_det['time_to']));

                        $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                        if($check_flag !== TRUE){
                            $error_flag = TRUE;
                            $return_obj['contract'] = 'fail';
                            $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                            $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_det['employee'], $selected_date, $error_array);
                            break;
                        }
                    }

                    //check monthly oncall hours
                    else if(in_array($slot_det['type'], $process_oncall_slot_types_array)){
                        $this_Ym = date('Y|m', strtotime($selected_date));
                        if(!isset($process_Ym[$this_Ym]) || empty($process_Ym[$this_Ym])){
                            $process_Ym[$this_Ym]['contract_hours'] = $employee->employee_contract_oncall_monthly_hour($slot_det['employee'], $this_Ym, TRUE);
                            $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($slot_det['employee'], $selected_date);
                            $process_Ym[$this_Ym]['work_hours'] = $this_day_employee_hours['monthly_oncall'];
                        }
                        if ($slot_det['time_from'] >= $slot_det['time_to']) {
                            $next_day_strtotime = strtotime(date('Y-m-d', strtotime($selected_date)) . ' +1 day');
                            $nextday_year_week = date('o|W', $next_day_strtotime);
                            $nextday_Ym = date('Y|m', $next_day_strtotime);
                            if($this_Ym == $nextday_Ym){
                                $process_Ym[$this_Ym]['work_hours'] = $employee->time_sum($process_Ym[$this_Ym]['work_hours'], $employee->time_difference($slot_det['time_from'], 24));
                                $process_Ym[$this_Ym]['work_hours'] = $employee->time_sum($process_Ym[$this_Ym]['work_hours'], $employee->time_difference(0, $slot_det['time_to']));
                            } else {
                                $process_Ym[$this_Ym]['work_hours'] = $employee->time_sum($process_Ym[$this_Ym]['work_hours'], $employee->time_difference($slot_det['time_from'], 24));
                            }
                            if($this_year_week != $nextday_year_week)
                                $carriage_slot[] = array('date' => $next_date, 'time_from' => 0, 'time_to' => $slot_det['time_to'], 'type' => $slot_det['type']);
                        } else
                            $process_Ym[$this_Ym]['work_hours'] = $employee->time_sum($process_Ym[$this_Ym]['work_hours'], $employee->time_difference($slot_det['time_from'], $slot_det['time_to']));

                        $check_flag = ($process_Ym[$this_Ym]['work_hours'] > $process_Ym[$this_Ym]['contract_hours'])? FALSE : TRUE;
                        if($check_flag !== TRUE){
                            $error_flag = TRUE;
                            $return_obj['contract'] = 'fail';
                            $error_array = array('oncall' => array('work_hours' => $process_Ym[$this_Ym]['work_hours'], 'contract_hours' => $process_Ym[$this_Ym]['contract_hours'], 'year_month' => $this_Ym));
                            $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_det['employee'], $selected_date, $error_array);
                            break;
                        }
                    }
                    
                    //**************************************

                    if(!$error_flag && !empty($carriage_slot)){
                        //calculate maximum available contract hours for a week
                        $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($slot_emp, $nextday_year_week, TRUE);

                        $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($slot_emp, $next_date);
                        $normal_work_hours_for_a_week = $this_day_employee_hours['weekly_normal'];

                        foreach($carriage_slot as $slot_det){

                            //check weekly normal hours
                            if(in_array($slot_det['type'], $process_normal_slot_types_array)){
                                $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, $employee->time_difference($slot_det['time_from'], $slot_det['time_to']));
                                $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                                if($check_flag !== TRUE){
                                    $error_flag = TRUE;
                                    $return_obj['contract'] = 'fail';
                                    $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $nextday_year_week));
                                    $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_emp, $slot_det['date'], $error_array);
                                    break;
                                }
                            }
                            //check monthly oncall hours
                            else if(in_array($slot_det['type'], $process_oncall_slot_types_array)){
                                $this_Ym = date('Y|m', strtotime($slot_det['date']));
                                if(!isset($process_Ym[$this_Ym]) || empty($process_Ym[$this_Ym])){
                                    $process_Ym[$this_Ym]['contract_hours'] = $employee->employee_contract_oncall_monthly_hour($slot_emp, $this_Ym, TRUE);
                                    $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($slot_emp, $slot_det['date']);
                                    $process_Ym[$this_Ym]['work_hours'] = $this_day_employee_hours['monthly_oncall'];
                                }
                                $process_Ym[$this_Ym]['work_hours'] = $employee->time_sum($process_Ym[$this_Ym]['work_hours'], $employee->time_difference($slot_det['time_from'], $slot_det['time_to']));
                                $check_flag = ($process_Ym[$this_Ym]['work_hours'] > $process_Ym[$this_Ym]['contract_hours'])? FALSE : TRUE;
                                if($check_flag !== TRUE){
                                    $error_flag = TRUE;
                                    $return_obj['contract'] = 'fail';
                                    $error_array = array('oncall' => array('work_hours' => $process_Ym[$this_Ym]['work_hours'], 'contract_hours' => $process_Ym[$this_Ym]['contract_hours'], 'year_month' => $this_Ym));
                                    $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_emp, $slot_det['date'], $error_array);
                                    break;
                                }
                            }

                        }
                    }
                    if($error_flag) break;
                }*/
                if($error_flag) break;
            }
        }
    }
    else {

        $this_employee = trim($_REQUEST['employee']);
        $time_from = trim($_REQUEST['time_from']);
        $time_to = trim($_REQUEST['time_to']);
        $date = trim($_REQUEST['date']);
        $slot_type = trim($_REQUEST['slotType']);
        $customer_to_add = trim($_REQUEST['customer']) != '' ? trim($_REQUEST['customer']) : NULL;
        if ($_SESSION['user_role'] == 4)  $customer_to_add = $_SESSION['user_id'];

        if($this_employee != '' && $time_from != '' && $time_to != ''){
            $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($this_employee, $date, array(), array(), array(), $customer_to_add, FALSE, TRUE);
            // $normal_work_hours_for_a_week = $this_day_employee_hours['weekly_normal'];
            // $oncall_work_hours_for_a_month = $this_day_employee_hours['monthly_oncall'];
            $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

            //-----------------------------------------------------
            if($time_from >= $time_to){
                $next_date = date('Y-m-d', strtotime($date. ' +1 day'));
                //check weekly normal hours
                $this_year_week = date('o|W', strtotime($date));
                $nextday_year_week = date('o|W', strtotime($next_date));

                $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($this_employee, $this_year_week, TRUE, $customer_to_add);
                $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($slot_type, $process_normal_slot_types_array) ? $employee->time_difference($time_from, 24) : ($employee->time_difference($time_from, 24) / 4));
                if($this_year_week == $nextday_year_week){
                    $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($slot_type, $process_normal_slot_types_array) ? $employee->time_difference(0, $time_to) : ($employee->time_difference(0, $time_to) / 4));
                    $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                    if($check_flag !== TRUE){
                        $return_obj['contract'] = 'fail';
                        $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                        $return_obj['contract_params'] = make_contract_fail_array($employee, $this_employee, $date, $error_array);
                    }
                }else{
                    $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                    if($check_flag !== TRUE){
                        $return_obj['contract'] = 'fail';
                        $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                        $return_obj['contract_params'] = make_contract_fail_array($employee, $this_employee, $date, $error_array);
                    } else {
                        $max_contract_hours_for_next_week = $employee->employee_contract_week_hour($this_employee, $nextday_year_week, TRUE, $customer_to_add);
                        $next_day_employee_hours = $employee->get_employee_total_working_hours_by_param($this_employee, $next_date, array(), array(), array(), $customer_to_add, FALSE, TRUE);
                        // $normal_work_hours_for_next_week = $next_day_employee_hours['weekly_normal'];
                        $normal_work_hours_for_next_week = $employee->time_sum($next_day_employee_hours['weekly_normal'], ($next_day_employee_hours['weekly_oncall'] / 4));
                        $normal_work_hours_for_next_week = $employee->time_sum($normal_work_hours_for_next_week, in_array($slot_type, $process_normal_slot_types_array) ? $employee->time_difference(0, $time_to) : ($employee->time_difference(0, $time_to) / 4));
                        $check_flag = ($normal_work_hours_for_next_week > $max_contract_hours_for_next_week)? FALSE : TRUE;
                        if($check_flag !== TRUE){
                            $return_obj['contract'] = 'fail';
                            $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_next_week, 'contract_hours' => $max_contract_hours_for_next_week, 'year_week' => $nextday_year_week));
                            $return_obj['contract_params'] = make_contract_fail_array($employee, $this_employee, $next_date, $error_array);
                        }
                    }
                }
            } 
            else {
                //check weekly normal hours
                // if(in_array($slot_type, $process_normal_slot_types_array)){
                    $this_year_week = date('o|W', strtotime($date));
                    $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($this_employee, $this_year_week, TRUE, $customer_to_add);
                    $normal_work_hours_for_a_week = $employee->time_sum($normal_work_hours_for_a_week, in_array($slot_type, $process_normal_slot_types_array) ? $employee->time_difference($time_from, $time_to) : ($employee->time_difference($time_from, $time_to) / 4));
                    $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                    if($check_flag !== TRUE){
                        $return_obj['contract'] = 'fail';
                        $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                        $return_obj['contract_params'] = make_contract_fail_array($employee, $this_employee, $date, $error_array);
                    }
                // }
            }
        }
    }
}
//echo ($emp_contract_check == 1 ? 'success' : 'fail');
//$return_obj['contract'] = ($emp_contract_check == 1 ? 'success' : 'fail');

/**
* @author: Niyaz <niyaz@arioninfotech.com>
* type_check: 19
* for: slot approval candg
* @request-from: gdschema_alloc_window
*/
else if($_REQUEST['type_check'] == 19){
    if($_REQUEST['approve_multi'] == 1){
        $ids = explode("-",$_REQUEST['ids']);
        $slot_dets = $employee->get_multiple_slot_details($ids);

        $employee_grouped_data = array();
        if(!empty($slot_dets)){
            foreach($slot_dets as $slot_det){
                $override_employee = $slot_det['employee'];
                $override_customer = $slot_det['customer'];

                if($override_employee == '' || $override_customer == '') continue;
                $employee_grouped_data[$override_employee][date('o|W', strtotime($slot_det['date']))][$override_customer][] = array(
                                'id'            =>  $slot_det['id'], 
                                'employee'      =>  $override_employee,
                                'customer'      =>  $override_customer, 
                                'date'          =>  $slot_det['date'], 
                                'time_from'     =>  $slot_det['time_from'], 
                                'time_to'       =>  $slot_det['time_to'], 
                                'type'          =>  $slot_det['type'], 
                                'status'        =>  $slot_det['status'], 
                                'alloc_emp'     =>  $slot_det['alloc_emp'], 
                                'relation_id'   =>  $slot_det['relation_id'],
                                'fkkn'          =>  $slot_det['fkkn']);
            }
        }
        // echo "<pre>".print_r($employee_grouped_data, 1)."</pre>";
        $employee_contract_failed_data = array();
        if(!empty($employee_grouped_data)){
            $error_flag = FALSE;
            foreach($employee_grouped_data as $this_employee => $year_week_datas){
                foreach($year_week_datas as $slot_year_week => $slot_dets_week){
                    $first_data_date = $slot_dets_week[0]['date'];
                    foreach($slot_dets_week as $slot_customer => $slot_dets){

                        $process_ids = array();
                        $updating_records = array();

                        foreach($slot_dets as $slot_index => $slot_det){
                            $process_ids[] = $slot_det['id'];
                            $updating_records[] = array('time_from' => $slot_det['time_from'], 'time_to' => $slot_det['time_to'], 'type' => $slot_det['type']);
                        }

                        $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($this_employee, $first_data_date, array(), $updating_records, $process_ids, $slot_customer, FALSE, TRUE);
                        $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

                        $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($this_employee, $slot_year_week, TRUE, $slot_customer);
                        // $emp_contract_check = $employee->check_employee_contract($this_employee, $first_data_date, $employee_work_hours);
                        $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
                        if($check_flag !== TRUE){
                            $error_flag = TRUE;
                            $return_obj['contract'] = 'fail';
                            $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $slot_year_week));
                            $return_obj['contract_params'] = make_contract_fail_array($employee, $this_employee, $first_data_date, $error_array);
                            break;
                        }
                    }

                    if($error_flag) break;

                }
                if($error_flag) break;
            }
        } 
    }else{
        $slot_det = $employee->customer_employee_slot_details($_REQUEST['id']);
        if($slot_det['customer'] != '' && $slot_det['employee'] != ''){
            $this_day_employee_hours = $employee->get_employee_total_working_hours_by_param($slot_det['employee'], $slot_det['date'], $slot_det['id'], array(), array(), $slot_det['customer'], FALSE, TRUE);
            $normal_work_hours_for_a_week = $employee->time_sum($this_day_employee_hours['weekly_normal'], ($this_day_employee_hours['weekly_oncall'] / 4));

            // $emp_contract_check = $employee->check_employee_contract($slot_det['employee'],$slot_det['date'],$employee_work_hours);
            $this_year_week = date('o|W', strtotime($slot_det['date']));
            $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($slot_det['employee'], $this_year_week, TRUE, $slot_det['customer']);
            $check_flag = ($normal_work_hours_for_a_week > $max_contract_hours_for_a_week)? FALSE : TRUE;
            if($check_flag !== TRUE){
                $return_obj['contract'] = 'fail';
                $error_array = array('normal' => array('work_hours' => $normal_work_hours_for_a_week, 'contract_hours' => $max_contract_hours_for_a_week, 'year_week' => $this_year_week));
                $return_obj['contract_params'] = make_contract_fail_array($employee, $slot_det['employee'], $slot_det['date'], $error_array);
            }
        }
    }
}
echo json_encode($return_obj);


function make_contract_fail_array($obj_emp, $emp_name, $date, $error_data = array(), $previous_error_data = array()){
    $smarty = new smartySetup(array('messages.xml'), FALSE);
    $contract_emp_details = $obj_emp->employee_detail('\''.trim($emp_name).'\'');
    $this_emp_privileges = $obj_emp->get_privileges($_SESSION['user_id'], 1);
    /*
     * js msg
     * var contract_exceed_msg = data.contract_params.last_name+ ' ' + data.contract_params.first_name;
        contract_exceed_msg += ' {$translate.contract_time_exceeded_continue} ';
        contract_exceed_msg += data.contract_params.work_hours + '(' + data.contract_params.contract_hours +'), {$translate.do_you_want_to_continue}';
     */
    /* $error_data format: 
      array(
            'normal' => array('work_hours' => ?, 'contract_hours' => ?),    'year_week' => ?
            'oncall' => array('work_hours' => ?, 'contract_hours' => ?)     'year_month' => ?
        );
     */
    
    $error_msg = '';
    if(!empty($previous_error_data) && $previous_error_data['error_msg'] != ''){
        $error_msg = $previous_error_data['error_msg'].'<br/><br/>';
        $error_msg = str_replace('<br>' . $smarty->translate['do_you_want_to_continue'], '', $error_msg);
    }
    
    $normal_error_msg = $oncall_error_msg = '';
    if(isset($error_data['normal']) && !empty($error_data['normal']))
        $normal_error_msg = $smarty->translate['normal_work_hours'].' - '.$error_data['normal']['work_hours'] . ' (' . $error_data['normal']['contract_hours'] . ')' ;
    if(isset($error_data['oncall']) && !empty($error_data['oncall']))
        $oncall_error_msg = $smarty->translate['oncall_work_hours'].' - '.$error_data['oncall']['work_hours'] . ' (' . $error_data['oncall']['contract_hours'] . ')' ;
    
    if($this_emp_privileges['contract_override'] == 1){
        $error_msg .= '<b>'.$contract_emp_details[0]['last_name'] . ' '. $contract_emp_details[0]['first_name']. '</b> ';
        $error_msg .= $smarty->translate['contract_time_exceeded_continue']. ' <br>';
        $error_msg .= $normal_error_msg. ($normal_error_msg != '' ? ($oncall_error_msg != '' ? ', <br>' : '. <br>') : '');
        $error_msg .= $oncall_error_msg. ($oncall_error_msg != '' ? '.' : '');
        $error_msg .= '<br>' . $smarty->translate['do_you_want_to_continue'];
    } else {
        $error_msg .= $contract_emp_details[0]['last_name'] . ' '. $contract_emp_details[0]['first_name']. ' ';
        $error_msg .= $smarty->translate['contract_time_exceed']. ' <br>';
        $error_msg .= $normal_error_msg. ($normal_error_msg != '' ? ($oncall_error_msg != '' ? ', <br>' : '. <br>') : '');
       // $error_msg .= ($normal_error_msg != '' ? ', <br>' : '') . $oncall_error_msg;
        $error_msg .= $oncall_error_msg. ($oncall_error_msg != '' ? '.' : '');
    }
    
    $return_array = array(
        'first_name'    => $contract_emp_details[0]['first_name'],
        'last_name'     => $contract_emp_details[0]['last_name'],
        'date'          => trim($date),
        'error_msg'     => $error_msg,
    );
    return $return_array;
}
?>