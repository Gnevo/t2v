<?php
/**
 * @author: Niyaz <niyaz@arioninfotech.com>
 * for: check whether employee contract hours exceeded or not
 * * rule: should accept parameters only as $_REQUEST mode... (because it might called from ajax_check_atl_and_contract.php)
*/
require_once('class/employee.php');
require_once('class/user.php');
$employee = new employee();
$obj_user = new user();
$emp_contract_check = 1;

if($_REQUEST['type_check'] == 1){
    $empl_contract_check_time = $employee->check_employee_total_time($_REQUEST['empl'], $_REQUEST['date'],$_REQUEST['ids']);
    $emp_contract_check = $employee->check_employee_contract($_REQUEST['empl'],$_REQUEST['date'],$empl_contract_check_time);
}
else if($_REQUEST['type_check'] == 2){
    $empl_contract_check_time = $employee->check_employee_total_time($_REQUEST['select_emp'], $_REQUEST['date'],$_REQUEST['id']);
    $emp_contract_check = $employee->check_employee_contract($_REQUEST['select_emp'],$_REQUEST['date'],$empl_contract_check_time);
}
else if($_REQUEST['type_check'] == 3 && $_REQUEST['employee'] != ""){
    
    $empl_contract_check_time = $employee->check_employee_total_time($_REQUEST['employee'], $_REQUEST['date'],null,$_REQUEST['multiple']);
    $emp_contract_check = $employee->check_employee_contract($_REQUEST['employee'],$_REQUEST['date'],$empl_contract_check_time);
}
else if($_REQUEST['type_check'] == 4 && $_REQUEST['employee'] == ""){
    if($_SESSION['user_role'] == 3){
        $slot = $_REQUEST['time_from']."-".$_REQUEST['time_to'];
        $empl_contract_check_time = $employee->check_employee_total_time($_SESSION['user_id'], $_REQUEST['date'],null,$slot);
        $emp_contract_check = $employee->check_employee_contract($_SESSION['user_id'],$_REQUEST['date'],$empl_contract_check_time);
    }
}
else if($_REQUEST['type_check'] == 4 && $_REQUEST['employee'] != ""){
    $slot = $_REQUEST['time_from']."-".$_REQUEST['time_to'];
    $empl_contract_check_time = $employee->check_employee_total_time($_REQUEST['employee'], $_REQUEST['date'],null,$slot);
    $emp_contract_check = $employee->check_employee_contract($_REQUEST['employee'],$_REQUEST['date'],$empl_contract_check_time);
    
}
else if($_REQUEST['type_check'] == 5){
    $empl_contract_check_time = $employee->check_employee_total_time($_REQUEST['employee'], $_REQUEST['date'],$_REQUEST['ids']);
    $emp_contract_check = $employee->check_employee_contract($_REQUEST['employee'],$_REQUEST['date'],$empl_contract_check_time);
}
else if($_REQUEST['type_check'] == 6){
    $empl_contract_check_time = $employee->check_employee_total_time($_REQUEST['employee'], $_REQUEST['date'],$_REQUEST['id']);
    $emp_contract_check = $employee->check_employee_contract($_REQUEST['employee'],$_REQUEST['date'],$empl_contract_check_time);
    
}
else if($_REQUEST['type_check'] == 7){
    if($_REQUEST['action'] == 'add_cust'){
        $slot_det = $employee->customer_employee_slot_details($_REQUEST['id']);
        if($slot_det['employee'] != ''){
            $empl_contract_check_time = $employee->check_employee_total_time($slot_det['employee'], $_REQUEST['date'],$_REQUEST['id']);
            $emp_contract_check = $employee->check_employee_contract($slot_det['employee'],$_REQUEST['date'],$empl_contract_check_time);
        }
    } else {        //action == 'add_emp'
        $empl_contract_check_time = $employee->check_employee_total_time($_REQUEST['emp_alloc'], $_REQUEST['date'],$_REQUEST['id']);
        $emp_contract_check = $employee->check_employee_contract($_REQUEST['emp_alloc'],$_REQUEST['date'],$empl_contract_check_time);
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
    
    $slot_ids = explode(",", $obj_user->retrieve_from_temp_session(1));
    $slots = "";
    $i = 0;
    foreach($slot_ids as $slot_id){
        if($i != 0) $slots .= ",";
        $slots .= $slot_id;
        $i++;
    }
    
        
    $slot_dets = $obj_dona->customer_employee_multi_slot_details($slots, 1);
    $slots_array_of_employees = array();
    foreach($slot_dets as $slot_det){
        if($slot_det['customer'] == '' || $slot_det['employee'] == '') 
            continue;
//            $slots_array_of_employees[$slot_det['employee']][] = $slot_det['id'];
//            $slots_array_of_employees[$slot_det['employee']][] = array('id' => $slot_det['id'], 'date' => $slot_det['date']);
        $slots_array_of_employees[$slot_det['employee']]['ids'][] = $slot_det['id'];
        $slots_array_of_employees[$slot_det['employee']]['dates'][] = $slot_det['date'];
    }
    if(!empty($slots_array_of_employees)){
        foreach ($slots_array_of_employees as $this_employee => $datas) {
            $contract_checking_slots = implode(',', $datas['ids']);
            $paste_date = '';
            if($_REQUEST['to_single_day'] || $_REQUEST['action'] == 'paste'){
                $paste_date = $_REQUEST['date'];
            }else{
                $paste_date = date('Y-m-d', strtotime(substr($_REQUEST['date'], 0,4)."W".substr($_REQUEST['date'], 5,2).date("N", strtotime($datas['dates'][0]))));
            }
            $empl_contract_check_time = $employee->check_employee_total_time($this_employee, $paste_date, $contract_checking_slots);
            $emp_contract_check = $employee->check_employee_contract($this_employee, $paste_date, $empl_contract_check_time);

            if($emp_contract_check != 1) break;
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
        
        $new_slot_duration = $_REQUEST['time_from']."-".$_REQUEST['time_to'];
        $empl_contract_check_time = $employee->check_employee_total_time($slot_det['employee'], $slot_det['date'], NULL, $new_slot_duration, array($_REQUEST['id']));
        $emp_contract_check = $employee->check_employee_contract($slot_det['employee'], $slot_det['date'], $empl_contract_check_time);

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
//        $slot_from = $_REQUEST['slot_from'];
//        $slot_to = $_REQUEST['slot_to'];
        
        $this_customer = ($slot_det['customer'] != '' ? $slot_det['customer'] : NULL);
        $fail_flag = FALSE;
        foreach($personal_meeting_employees as $this_emp){
                if($this_emp == $slot_det['employee']){  //check is this current slot?
                    if($slot_det['customer'] != '' ) {
                        $slot_period = $time_from. "-" .$time_to;
                        $empl_contract_check_time = $employee->check_employee_total_time($this_emp, $slot_det['date'], NULL, $slot_period, array($slot_det['id']));
                        $emp_contract_check = $employee->check_employee_contract($this_emp, $slot_det['date'], $empl_contract_check_time);
//                        echo "$empl_contract_check_time - $emp_contract_check";
                    }
                    if ($emp_contract_check != 1){
                        $fail_flag = TRUE;
                        break;
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
                                $slot_period = $time_from. "-" .$time_to;
                                $empl_contract_check_time = $employee->check_employee_total_time($atl_slots['employee'], $atl_slots['date'], NULL, $slot_period, $atl_exception_slot_ids);
                                $emp_contract_check = $employee->check_employee_contract($atl_slots['employee'], $atl_slots['date'], $empl_contract_check_time);

                                if ($emp_contract_check != 1){
                                    $fail_flag = TRUE;
                                    break;
                                }
                            }
                            if($this_exist_slot['customer'] != ''){
                                $atl_slots = $atl_slots[0];
                                $slot_period = $this_exist_slot['time_from']. "-" .$this_exist_slot['time_to'];
                                $empl_contract_check_time = $employee->check_employee_total_time($this_emp, $this_exist_slot['date'], NULL, $slot_period);
                                $emp_contract_check = $employee->check_employee_contract($this_emp, $this_exist_slot['date'], $empl_contract_check_time);

                                if ($emp_contract_check != 1){
                                    $fail_flag = TRUE;
                                    break;
                                }
                            }
                        }
                    } else {
                        //else part is for creating new timeslot with new employee and slot credentials
                        $atl_slots = $atl_slots[0];
                        $slot_period = $time_from. "-" .$time_to;
                        $empl_contract_check_time = $employee->check_employee_total_time($this_emp, $slot_det['date'], NULL, $slot_period);
                        $emp_contract_check = $employee->check_employee_contract($this_emp, $slot_det['date'], $empl_contract_check_time);

                        if ($emp_contract_check != 1){
                            $fail_flag = TRUE;
                            break;
                        }
                    }
                }
                if($fail_flag) break;
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
    $from_year = date('Y');
    $from_week = $_REQUEST['from_week'];
    $to_year = substr($_REQUEST['to_week'], 0, 4);
    $to_week = str_pad(substr($_REQUEST['to_week'],5,2), 2, '0', STR_PAD_LEFT);
    $temp_to_week = $to_week;
    if($_REQUEST['to_single_slot'])
        $slot_dets[0] = $employee->customer_employee_slot_details($_REQUEST['id']);
    else    
        $slot_dets = $employee->timetable_customer_employee_slots_copiable_for_copy($_REQUEST['customer'], $_REQUEST['date'], $_REQUEST['employee']);
    
    $slots_array_of_employees = array();
    if(!empty($slot_dets)){
        foreach($slot_dets as $slot_det){
            if($slot_det['customer'] == '' || $slot_det['employee'] == '') 
                continue;
            $slots_array_of_employees[$slot_det['employee']][] = $slot_det;
        }
    }
    if(!empty($slots_array_of_employees)){
        foreach($slots_array_of_employees as $this_employee => $slot_dets){
            if($to_year > $from_year) $to_week = 52;
            $paste_year = date('Y');
            for($i = $from_week; $i <= $to_week; $i++){
                $empl_contract_check_time = 0;

                $paste_week = str_pad($i, 2,'0',STR_PAD_LEFT);
                //calculate maximum available contract hours for a week
                $paste_year_week = $paste_year.'|'.$paste_week;
                $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($this_employee, $paste_year_week, TRUE);
//                echo '<br>----------------------------------------------------<br>';
                foreach ($days as $day) {
                    foreach($slot_dets as $slot_det){
                    
                        $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.$day));
                        $slot_contract = $slot_det['time_from'].'-'.$slot_det['time_to'];
                        $tmp_empl_contract_check_time = $employee->check_employee_total_time($this_employee, $paste_date, NULL, $slot_contract);
                        $empl_contract_check_time = $employee->time_sum($empl_contract_check_time, $tmp_empl_contract_check_time);
//                        echo $day.'='.$empl_contract_check_time .'-'. $max_contract_hours_for_a_week.'<br/>';
                        $emp_contract_check = ($empl_contract_check_time > $max_contract_hours_for_a_week)? 2 : 1;
                        if($emp_contract_check != 1) break;
                        
                        if($to_year > $from_year && $i == 52){
                            $i=1;
                            $to_week = $temp_to_week;
                            $paste_year = substr($_REQUEST['to_week'],0,4);
                        }
                    }
                    

                    if($emp_contract_check != 1) break;
                        
                    $i++;
                    $i += $_REQUEST['from_option'];
                }
                if($emp_contract_check != 1) break;
            }
            if($emp_contract_check != 1) break;
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
//        echo "<pre>Copiable: ".print_r($slot_dets, 1)."</pre>";
        $slots_array_of_employees = array();
        if(!empty($slot_dets)){
            foreach($slot_dets as $slot_det){
                if($slot_det['customer'] == '' || $slot_det['employee'] == '') continue;
//                $slots_array_of_employees[$slot_det['employee']][] = $slot_det;
                $slots_array_of_employees[$slot_det['employee']][date('Y|W', strtotime($slot_det['date']))][] = $slot_det;
            }
        }
//        echo "<pre>Updated: ".print_r($slots_array_of_employees, 1)."</pre>";
        
        if(!empty($slots_array_of_employees)){
            $paste_year = substr($_REQUEST['to_week'],0,4);
            $paste_week = str_pad(substr($_REQUEST['to_week'],5), 2,'0',STR_PAD_LEFT);
            
            foreach($slots_array_of_employees as $this_employee => $year_week_datas){
                for($i = 1; $i <= $_REQUEST['no_of_times']; $i++){
                    
//                    $paste_year_week = $paste_year.'|'.$paste_week;
//                    echo "<br>---------$i  $this_employee------------------------------------------<br>";
                    foreach($year_week_datas as $slot_year_week => $slot_dets){
                        
                        $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.date("N", strtotime($slot_dets[0]['date']))));
//                        $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week. '1'));
                        $paste_date = date('Y-m-d', strtotime($paste_date . ' +'.(($i-1)*7).' days'));
                        
                        //calculate maximum available contract hours for a week
                        $paste_year_week = date('Y|W', strtotime($paste_date));
                        $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($this_employee, $paste_year_week, TRUE);

                        $new_contract_slots = '';
                        foreach($slot_dets as $slot_index => $slot_det){
                            if($slot_index != 0) $new_contract_slots .= ',';
                            $new_contract_slots .= $slot_det['time_from'].'-'.$slot_det['time_to'];
                        }
                        
                        $empl_contract_check_time = $employee->check_employee_total_time($this_employee, $paste_date, NULL, $new_contract_slots);
//                        echo '<br>'. $empl_contract_check_time .'-'. $max_contract_hours_for_a_week.'<br/>';
                        $emp_contract_check = ($empl_contract_check_time > $max_contract_hours_for_a_week)? 2 : 1;
                        if($emp_contract_check != 1) break;

                    }

                    if($emp_contract_check != 1) break;
                }
                if($emp_contract_check != 1) break;
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
    foreach($sel_slots_array as $key => $val){
        if(trim($val) == '') unset ($sel_slots_array[$key]);
    }
    
    $i = 0;
    $days = explode('-', $_REQUEST['days']);
    array_pop($days);
    $from_year = date('Y', strtotime($sel_date));
    $from_week = trim($_REQUEST['from_week']);
    $to_year = substr($_REQUEST['to_week'], 0, 4);
    $to_week = str_pad(substr($_REQUEST['to_week'],5,2), 2, '0', STR_PAD_LEFT);
    $temp_to_week = $to_week;
    
    $slot_dets = $employee->get_multiple_slot_details($sel_slots_array, $sel_date);
    $total_no_of_slots = count($slot_dets);
    for($x = 0 ; $x < $total_no_of_slots; $x++)
        $slot_dets[$x]['employee'] = $sel_employee_to_assign;
    
//    echo "<pre>Copiable: ".print_r($slot_dets, 1)."</pre>";

    if(!empty($slot_dets)){
        if($to_year > $from_year) $to_week = 52;
        $paste_year = $from_year;
        for($i = $from_week; $i <= $to_week; $i++){
            $empl_contract_check_time = 0;

            $paste_week = str_pad($i, 2,'0',STR_PAD_LEFT);
            //calculate maximum available contract hours for a week
            $paste_year_week = $paste_year.'|'.$paste_week;
            $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($sel_employee_to_assign, $paste_year_week, TRUE);
//                echo '<br>----------------------------------------------------<br>';
            foreach ($days as $day) {
                foreach($slot_dets as $slot_det){

                    $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.$day));
                    $slot_contract = $slot_det['time_from'].'-'.$slot_det['time_to'];
                    $tmp_empl_contract_check_time = $employee->check_employee_total_time($sel_employee_to_assign, $paste_date, NULL, $slot_contract);
                    $empl_contract_check_time = $employee->time_sum($empl_contract_check_time, $tmp_empl_contract_check_time);
//                        echo $day.'='.$empl_contract_check_time .'-'. $max_contract_hours_for_a_week.'<br/>';
                    $emp_contract_check = ($empl_contract_check_time > $max_contract_hours_for_a_week)? 2 : 1;
                    if($emp_contract_check != 1) break;

                    if($to_year > $from_year && $i == 52){
                        $i=1;
                        $to_week = $temp_to_week;
                        $paste_year = substr($_REQUEST['to_week'],0,4);
                    }
                }


                if($emp_contract_check != 1) break;

                $i++;
                $i += $from_option;
            }
            if($emp_contract_check != 1) break;
        }
    }
}

/**
* @author: Shamsudheen <shamsu@arioninfotech.com>
* type_check: 14 
* for: 'schema drag-n-drop | schema manual entry' timeslot(s) operation from alloc_window
*/
else if($_REQUEST['type_check'] == 14){
    
    $sel_date = trim($_REQUEST['date']);
    $from_option = trim($_REQUEST['from_option']);
    $days = explode('-', $_REQUEST['days']);
    array_pop($days);
    $from_year = date('Y', strtotime($sel_date));
    $from_week = trim($_REQUEST['from_week']);
    $to_year = substr($_REQUEST['to_week'], 0, 4);
    $to_week = str_pad(substr($_REQUEST['to_week'],5,2), 2, '0', STR_PAD_LEFT);

    $__slot_employee = trim($_REQUEST['employee']);
    $__slot_customer = trim($_REQUEST['customer']);
    $time_from = trim($_REQUEST['time_from']);
    $time_to = trim($_REQUEST['time_to']);
    $i = 0;
    $temp_to_week = $to_week;
        
    if($__slot_employee != '' && $__slot_customer != ''){
        if($to_year > $from_year) $to_week = 52;
        $paste_year = $from_year;
        for($i = $from_week; $i <= $to_week; $i++){
            $empl_contract_check_time = 0;

            $paste_week = str_pad($i, 2,'0',STR_PAD_LEFT);
            //calculate maximum available contract hours for a week
            $paste_year_week = $paste_year.'|'.$paste_week;
            $max_contract_hours_for_a_week = $employee->employee_contract_week_hour($__slot_employee, $paste_year_week, TRUE);
//                echo '<br>----------------------------------------------------<br>';
            foreach ($days as $day) {

                $paste_date = date('Y-m-d', strtotime($paste_year."W".$paste_week.$day));
                $slot_contract = $time_from.'-'.$time_to;
                $tmp_empl_contract_check_time = $employee->check_employee_total_time($__slot_employee, $paste_date, NULL, $slot_contract);
                $empl_contract_check_time = $employee->time_sum($empl_contract_check_time, $tmp_empl_contract_check_time);
//                        echo $day.'='.$empl_contract_check_time .'-'. $max_contract_hours_for_a_week.'<br/>';
                $emp_contract_check = ($empl_contract_check_time > $max_contract_hours_for_a_week)? 2 : 1;

                if($emp_contract_check != 1) break;
                
                if($to_year > $from_year && $i == 52){
                    $i=1;
                    $to_week = $temp_to_week;
                    $paste_year = substr($_REQUEST['to_week'],0,4);
                }
                $i++;
                $i += $from_option;
            }
            if($emp_contract_check != 1) break;
        }
    }
}


/**
* @author: Shamsudheen <shamsu@arioninfotech.com>
* type_check: 15
* for: 'swap' timeslot(s) operation <slot-manage>
*/
else if($_REQUEST['type_check'] == 15){
    
    $emp_contract_check1 = $emp_contract_check2 = 1;
    if(isset($_SESSION['swap']) && isset($_REQUEST['id'])){
        $slot_det1 = $employee->customer_employee_slot_details($_SESSION['swap']);
        $slot_det2 = $employee->customer_employee_slot_details($_REQUEST['id']);
        
        if(!empty($slot_det1) && !empty($slot_det2)){
            //source slot<swaped previous>
            if($slot_det1['customer'] != '' && $slot_det1['employee'] != ''){
                $empl_contract_check_time = $employee->check_employee_total_time($slot_det1['employee'], $slot_det2['date'], $slot_det1['id'], NULL, array($slot_det1['id']));
                $emp_contract_check1 = $employee->check_employee_contract($slot_det1['employee'],$slot_det2['date'],$empl_contract_check_time);
//                echo $slot_det1['employee'].": $empl_contract_check_time < $emp_contract_check >";
            }
            
            //source slot<swaped previous>
            if($slot_det2['customer'] != '' && $slot_det2['employee'] != ''){
                $empl_contract_check_time = $employee->check_employee_total_time($slot_det2['employee'], $slot_det1['date'], $slot_det2['id'], NULL, array($slot_det2['id']));
                $emp_contract_check2 = $employee->check_employee_contract($slot_det2['employee'],$slot_det1['date'],$empl_contract_check_time);
//                echo $slot_det2['employee'].": $empl_contract_check_time < $emp_contract_check >";
            }
        }
    }
    
    $emp_contract_check = ($emp_contract_check1 == 1 && $emp_contract_check2 == 1 ? 1 : 2);
    
}


//echo ($emp_contract_check == 1 ? 'success' : 'fail');
$return_obj['contract'] = ($emp_contract_check == 1 ? 'success' : 'fail');
echo json_encode($return_obj);
?>