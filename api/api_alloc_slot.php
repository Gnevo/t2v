<?php
    session_name('t2v-cirrus');
    session_start('t2v-cirrus');
    $app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
    chdir ($app_dir);
    require_once('class/setup.php');
//    require_once('class/leave.php');
    require_once('class/dona.php');
    require_once('class/employee.php');
    require_once('plugins/message.class.php');
    //time_from, time_to, employee, date, customer, emp_alloc, fkkn, type, comment
    $smarty = new smartySetup(array("user.xml"), FALSE);
//    $leave = new leave();
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
    
    $obj = array();
    
    $obj[0] = new stdClass();
    
    //Edit action
    if($action == 'EDIT'){
        $process_flag =  TRUE;
        
//        if($time_from >= $time_to){
//            $process_flag = FALSE;
//            $msg->set_message('fail', 'time_from_must_less_than_time_to');
//            $message_data = $msg->show_message_data_for_gritter();
//            $obj[0]->message = $message_data->message;
//        }

        if($process_flag){
            $slot_details = $dona->customer_employee_slot_details($slot_id);

            //to check old slot has already signed or not if employee/customer changed
            if($slot_details['customer'] != '' && $slot_details['employee'] != '' && ($slot_customer != $slot_details['customer'] || $slot_employee != $slot_details['employee'])){
                if($obj_emp->chk_employee_rpt_signed($slot_details['employee'], $slot_details['customer'], $slot_details['date'], TRUE)){
                      $process_flag = FALSE;  
                      $message_data = $msg->show_message_data_for_gritter();
                      $obj[0]->message = $message_data->message;
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
            $obj[0]->message = $message_data->message;
        }
        $obj[0]->status = $process_flag;  
    }
    //Create Action
    else {
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

            if (!$obj_emp->findout_slot_alteration_bug($process_params)) 
                $process_flag = FALSE;
            else {
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
            }
            
            if($process_flag){
                //if ($obj_emp->is_valid_slot($employee_to_add, $time_from, 24, $_REQUEST['date']) && $obj_emp->is_valid_slot($employee_to_add, 0, $time_to, $next_date)) {
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
                /*}else{
                    $process_flag = FALSE;
                    $msg->set_message('fail', 'slot_collide');
                }*/
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
            
            if($process_flag){
                //checking the time is valid
                //if ($obj_emp->is_valid_slot($employee_to_add, $time_from, $time_to, $_REQUEST['date'])) {
                    if ($dona->customer_employee_slot_add($employee_to_add , $_REQUEST['customer'], $_REQUEST['date'], $time_from, $time_to, $_REQUEST['emp_alloc'],$fkkn , $type , '', $comment, $status)) {
                        $msg->set_message('success', 'slot_added_success');
                    }else{
                        $process_flag = FALSE;
                        $msg->set_message('fail', 'insertion_failed');
                    }
                /*} else {
                    $process_flag = FALSE;
                    $msg->set_message('fail', 'slot_collide');
                }*/
            }
        }
        $obj[0]->status = $process_flag;
        $message_data = $msg->show_message_data_for_gritter();
        $obj[0]->message = $message_data->message;
    }
    echo json_encode($obj);
?>