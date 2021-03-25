<?php
    require_once('api_common_functions.php');
    $session_check = check_user_session();

    require_once('class/setup.php');
    require_once('class/dona.php');
    require_once('class/employee.php');
    require_once('plugins/message.class.php');
    //time_from, time_to, employee, date, customer, emp_alloc, fkkn, type, comment
    $smarty = new smartySetup(array("user.xml","gdschema.xml","messages.xml"), FALSE);
    $dona = new dona();
    $obj_emp = new employee();
    $msg = new message();
    
    $slot_id   = isset($_REQUEST['slot_id']) && $_REQUEST['slot_id'] != '' ? trim($_REQUEST['slot_id']) : NULL;
    $action         = isset($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'EDIT' && $slot_id != '' ? 'EDIT' : 'CREATE';
    
    $fkkn       = $_REQUEST['fkkn'];
    $type       = $_REQUEST['type'];
    $comment    = $_REQUEST['comment'];
    $status     = $_REQUEST['employee'] != '' && $_REQUEST['customer'] != '' ? 1 : 0;
    
    $time_from  = $dona->time_to_sixty($_REQUEST['time_from']);
    $time_to    = $dona->time_to_sixty($_REQUEST['time_to']);
    if ($time_to == 0) $time_to = 24;
    $employee_to_add    = $slot_employee = $_REQUEST['employee'];
    $slot_customer      = $_REQUEST['customer'];
    $inconv_split = (isset($_REQUEST['inconv_split']) && $_REQUEST['inconv_split']) ? 1:0;
    $inconv_split_check = (isset($_REQUEST['inconv_split_check']) && $_REQUEST['inconv_split_check']) ? 1:0;

    $obj = new stdClass();
    $obj->session_status = $session_check;
    $normal_slot_types = array('0', '1', '2', '4', '5', '6', '7', '8', '10', '11', '12', '15', '16');
    $oncall_slot_types = array('3', '9', '13', '14', '17');
    $memslot_type = $type;

    //Edit action
    if($action == 'EDIT'){
        $process_flag =  TRUE;
        
        if($process_flag){
            $slot_details = $dona->customer_employee_slot_details($slot_id);

            //to check old slot has already signed or not if employee/customer changed
            if($slot_details['customer'] != '' && $slot_details['employee'] != '' && ($slot_customer != $slot_details['customer'] || $slot_employee != $slot_details['employee'])){
                if($obj_emp->chk_employee_rpt_signed($slot_details['employee'], $slot_details['customer'], $slot_details['date'], TRUE)){
                      $process_flag = FALSE;  
                      $message_data = $msg->show_message_data_for_gritter();
                      $obj->message = $message_data->message;
                }
            }
        }
        
        if($process_flag){
            if($time_from >= $time_to){
                $process_params1 = array(
                'employee'  => $slot_employee,
                'customer'  => $slot_customer,
                'date'      => $_REQUEST['date'],
                'time_from' => $time_from,
                'time_to'   => 24,
                'type'      => $type,
                'fkkn'      => $fkkn);
                                
                if (!$obj_emp->findout_slot_alteration_bug($process_params1, array($slot_id))) {
                    $process_flag = FALSE;
                } else {
                    $process_params2 = array(
                        'employee'  => $slot_employee,
                        'customer'  => $slot_customer,
                        'date'      => date('Y-m-d', strtotime(date('Y-m-d', strtotime($_REQUEST['date'])) . ' +1 day')),
                        'time_from' => 0,
                        'time_to'   => $time_to,
                        'type'      => $type,
                        'fkkn'      => $fkkn);
                    if (!$obj_emp->findout_slot_alteration_bug($process_params2)) {
                        $process_flag = FALSE;
                    } else {
                        $process_params1['comment'] = $process_params2['comment'] = $comment;
                        //edit first day slot
                        $obj_emp->begin_transaction();
                        $dona->begin_transaction();
                        $process_flag = $obj_emp->update_slot_details($slot_id, $process_params1);

                        //create new slot in next day
                        if($process_flag){
                            $process_flag = $dona->customer_employee_slot_add($process_params2['employee'], $process_params2['customer'], $process_params2['date'], $process_params2['time_from'], $process_params2['time_to'], $_REQUEST['emp_alloc'], $process_params2['fkkn'], $process_params2['type'], '', $process_params2['comment']);
                        }

                        if(!$process_flag){
                            $obj_emp->rollback_transaction();
                            $dona->rollback_transaction();
                            $msg->set_message('fail', 'slot_editting_failed');
                        }else{
                            $obj_emp->commit_transaction();
                            $dona->commit_transaction();
                            $msg->set_message('success', 'slot_editting_success');
                        }
                    }
                }
            }else{
                $process_params = array(
                    'employee'  => $slot_employee,
                    'customer'  => $slot_customer,
                    'date'      => $_REQUEST['date'],
                    'time_from' => $time_from,
                    'time_to'   => $time_to,
                    'type'      => $type,
                    'fkkn'      => $fkkn);

                if (!$obj_emp->findout_slot_alteration_bug($process_params, array($slot_id))) {
                    $process_flag = FALSE;
                } else {
                    $process_params['comment'] = $comment;
                    $process_flag = $obj_emp->update_slot_details($slot_id, $process_params);
                    if(!$process_flag)
                        $msg->set_message('fail', 'slot_editting_failed');
                    else
                        $msg->set_message('success', 'slot_editting_success');

                }
                
            }
            $message_data = $msg->show_message_data_for_gritter();
            $obj->message = $message_data->message;
        }
        $obj->status = $process_flag;  
    }
    
    //Create Action
   
    else {
        $inconv_split_check_status = TRUE;
        $obj->split_status = FALSE;

        if($inconv_split_check){
            $selected_date = $_REQUEST['date'];
            

            $time_flag = 0;
            $time_flag_next = 0;
            $slot_split_time_flag = 0;
            $slot_split_time_flag_next = 0;

            if($time_from >= $time_to){ //if the slot enters next day
                $inconv_timings = $obj_emp->get_collided_inconvenients_on_a_day_for_customer($selected_date, $_REQUEST['customer'], $time_from, 24, 3);
                $next_date = date('Y-m-d', strtotime($selected_date .' +1 day'));
                $inconv_timings_next = $obj_emp->get_collided_inconvenients_on_a_day_for_customer($selected_date, $_REQUEST['customer'], 0, $time_to, 3);

                $time_flag = 0;
                if(!empty($inconv_timings)){
                    foreach ($inconv_timings as $item => $inconv_timing){
                        if(((float) $time_from >= (float)$inconv_timing['time_from'] && (float) $time_from < (float)$inconv_timing['time_to'])
                            && 
                           (24 > (float)$inconv_timing['time_from'] && 24 <= (float)$inconv_timing['time_to'])){
                                $time_flag = 1;
                        }
                    }
                }
                $time_flag_next = 0;
                if(!empty($inconv_timings_next)){
                    foreach ($inconv_timings_next as $item => $inconv_timing ){
                        if((0 >= (float) $inconv_timing['time_from'] && 0 < (float) $inconv_timing['time_to'])
                            && 
                           ((float) $time_to > (float)$inconv_timing['time_from'] && (float) $time_to <= (float)$inconv_timing['time_to'])){
                                $time_flag_next = 1;
                        }
                    }
                }


                //this checking for slot splitting conformation if have an oncall time in b/w them (by shamsu)
                if(!empty($inconv_timings)){
                    foreach ($inconv_timings as $item => $inconv_timing){
                        if(((float) $inconv_timing['time_from'] >= (float) $time_from && (float) $inconv_timing['time_from'] <= 24)
                            || 
                           ((float) $inconv_timing['time_to'] >= (float) $time_from && (float) $inconv_timing['time_to'] <= 24)){
                                $slot_split_time_flag = 1;
                        }
                    }
                }

                if(!empty($inconv_timings_next)){
                    foreach ($inconv_timings_next as $item => $inconv_timing){
                        if(((float) $inconv_timing['time_from'] >= 0 && (float) $inconv_timing['time_from'] <= (float) $time_to)
                            || 
                           ((float) $inconv_timing['time_to'] >= 0 && (float) $inconv_timing['time_to'] <= (float) $time_to)){
                                $slot_split_time_flag_next = 1;
                        }
                    }
                }

            }else {
                //if the slot time same day
                $inconv_timings = $obj_emp->get_collided_inconvenients_on_a_day_for_customer($selected_date, $_REQUEST['customer'], $time_from, $time_to, 3);
                $time_flag = 0;
                //echo "<pre>".print_r($inconv_timings)."</pre>";
                if(!empty($inconv_timings)){
                    foreach ($inconv_timings as $item => $inconv_timing){
                        if(((float) $time_from >= (float) $inconv_timing['time_from'] && (float) $time_from < (float) $inconv_timing['time_to'])
                            && 
                           ((float) $time_to > (float) $inconv_timing['time_from'] && (float) $time_to <= (float) $inconv_timing['time_to'])){
                                $time_flag = 1;
                        }
                    }
                }
                //this checking for slot splitting conformation if have an oncall time in b/w them (by shamsu)
                if(!empty($inconv_timings)){
                    foreach ($inconv_timings as $item => $inconv_timing){
                        if(((float) $inconv_timing['time_from'] >= (float) $time_from && (float) $inconv_timing['time_from'] <= (float) $time_to)
                            || 
                           ((float) $inconv_timing['time_to'] >= (float) $time_from && (float) $inconv_timing['time_to'] <= (float) $time_to)){
                                $slot_split_time_flag = 1;
                        }
                    }
                }
            }

            if(in_array($type, $oncall_slot_types) && ($time_flag == 0 || ($time_flag_next == 0 && $time_from >= $time_to))){  
                $inconv_split_check_status = FALSE;
                $obj->split_status = TRUE;
                $obj->status = FALSE;
                $obj->message = $smarty->translate['time_outside_oncall'];
            }elseif(in_array($type, $normal_slot_types) && ($time_flag == 1 || $time_flag_next == 1 || $slot_split_time_flag == 1 || $slot_split_time_flag_next == 1)){
                $inconv_split_check_status = FALSE;
                $obj->split_status = TRUE;
                $obj->status = TRUE;
                $obj->message = $smarty->translate['do_you_want_to_change_as_oncall_slot'];
            }
        }

        if($inconv_split_check_status){
            $intervals = array();    
            $process_flag =  TRUE;
            if ($time_from >= $time_to) { //if the slot enters next day
                $cur_date = strtotime($_REQUEST['date'] . ' 00:00:00');
                $next_date = date('Y-m-d', ($cur_date + 24 * 3600));
                
                $process_params = array(
                    'employee'  => $employee_to_add,
                    'customer'  => $_REQUEST['customer'],
                    'date'      => $_REQUEST['date'],
                    'time_from' => $time_from,
                    'time_to'   => 24,
                    'type'      => $type,
                    'fkkn'      => $fkkn);
                //echo "<pre>".print_r($process_params,1)."</pre>";
                if (!$obj_emp->findout_slot_alteration_bug($process_params)) 
                    $process_flag = FALSE;
                else {
                    //oncall check
                    //$memslot_type = trim($_REQUEST['memslottype']) != '' ? trim($_REQUEST['memslottype']) : 0;
                    if($inconv_split){
                        $inconv_timings = $obj_emp->get_collided_inconvenients_on_a_day_for_customer($_REQUEST['date'], $_REQUEST['customer'], $time_from, 24, 3);
                        // if($_SESSION['user_id'] == 'dodo001'){
                        //     echo "<pre>".print_r($inconv_timings,1)."</pre>";
                        //     exit();
                        // }
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
                            $intervals[] = array('time_from' => $time_from, 'time_to' => 24, 'type' => $type, 'date' => $_REQUEST['date']);
                        }

                    }    


                    $process_params = array(
                        'employee'  => $employee_to_add,
                        'customer'  => $_REQUEST['customer'],
                        'date'      => $next_date,
                        'time_from' => 0,
                        'time_to'   => $time_to,
                        'type'      => $type,
                        'fkkn'      => $fkkn);

                    if (!$obj_emp->findout_slot_alteration_bug($process_params)) 
                        $process_flag = FALSE;
                    else{
                        if($inconv_split){
                            $next_day_date = $next_date;
                            $inconv_timings_next = $obj_emp->get_collided_inconvenients_on_a_day_for_customer($next_day_date, $_REQUEST['customer'], 0, $time_to, 3);
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
                                        //$cur_time_type = 3;
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
                                $intervals[] = array('time_from' => 0, 'time_to' => $time_to, 'type' => $type, 'date' => $next_date);
                            }
                        }
                    }
                }
                //echo "<pre>".print_r($intervals,1)."</pre>";
                if($process_flag && empty($intervals)){
                    if ($dona->customer_employee_slot_add($employee_to_add, $_REQUEST['customer'], $_REQUEST['date'], $time_from, 24, $_REQUEST['emp_alloc'],$fkkn , $type , '', $comment, $status)) {
                        if ($dona->customer_employee_slot_add($employee_to_add, $_REQUEST['customer'], $next_date, 0, $time_to, $_REQUEST['emp_alloc'],$fkkn , $type , '', $comment, $status)) {
                            $msg->set_message('success', 'slot_added_success');
                        }
                        else{
                            $process_flag = FALSE;
                            $msg->set_message('fail', 'insertion_failed');
                        }
                    }else{
                        $process_flag = FALSE;
                        $msg->set_message('fail', 'insertion_failed');
                    }
                }elseif($process_flag && !empty($intervals)){
                    $dona->begin_transaction();
                    foreach ($intervals as $interval) {
                        if($interval['time_from'] == $interval['time_to']) continue;
                        if ($dona->customer_employee_slot_add($employee_to_add, $_REQUEST['customer'], $interval['date'], $interval['time_from'], $interval['time_to'], $_REQUEST['emp_alloc'], $fkkn, $interval['type'], '',$comment)) {
                            
                        }else{
                            $process_flag = FALSE;
                            break;
                        }
                    }
                    if($process_flag) {
                        $msg->set_message('success', 'slot_added_success');
                        $dona->commit_transaction ();
                        $process_flag = TRUE;
                    }else {
                        $process_flag = FALSE;
                        $msg->set_message('fail', 'insertion_failed');
                        $dona->rollback_transaction ();
                    }

                }
            } else {//if the time slot is on same day
                $process_params = array(
                    'employee'  => $employee_to_add,
                    'customer'  => $_REQUEST['customer'],
                    'date'      => $_REQUEST['date'],
                    'time_from' => $time_from,
                    'time_to'   => $time_to,
                    'type'      => $type,
                    'fkkn'      => $fkkn);

                if (!$obj_emp->findout_slot_alteration_bug($process_params)) 
                    $process_flag = FALSE;
                else{
                    if($inconv_split == 1){
                        $inconv_timings = $obj_emp->get_collided_inconvenients_on_a_day_for_customer($_REQUEST['date'], $_REQUEST['customer'], $time_from, $time_to, 3);
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
                        }                    
                    }
                }
                if($process_flag && empty($intervals)){
                    if ($dona->customer_employee_slot_add($employee_to_add , $_REQUEST['customer'], $_REQUEST['date'], $time_from, $time_to, $_REQUEST['emp_alloc'],$fkkn , $type , '', $comment, $status)) {
                        $msg->set_message('success', 'slot_added_success');
                    }else{
                        print_r($dona->query_error_details);
                        $process_flag = FALSE;
                        $msg->set_message('fail', 'insertion_failed');
                    }
                }elseif($process_flag && !empty($intervals)){
                    $dona->begin_transaction();
                    foreach ($intervals as $interval) {
                        if($interval['time_from'] == $interval['time_to']) continue;
                        if ($dona->customer_employee_slot_add($employee_to_add, $_REQUEST['customer'], $_REQUEST['date'], $interval['time_from'], $interval['time_to'], $_REQUEST['emp_alloc'], $fkkn, $interval['type'], '',$comment)) {
                            
                        }else{
                            $process_flag = FALSE;
                            break;
                        }
                    }
                    if($process_flag) {
                        $msg->set_message('success', 'slot_added_success');
                        $dona->commit_transaction ();
                        $process_flag = TRUE;
                    }else {
                        $process_flag = FALSE;
                        $msg->set_message('fail', 'insertion_failed');
                        $dona->rollback_transaction ();
                    }
                }
            }
            $obj->status = $process_flag;
            $message_data = $msg->show_message_data_for_gritter();
            $obj->message = $message_data->message;
        }
    }
    echo json_encode($obj);
?>