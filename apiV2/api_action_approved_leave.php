<?php

require_once('api_common_functions.php');
$session_check = check_user_session();


require_once('class/setup.php');
require_once('class/dona.php');
require_once('class/employee.php');
require_once('plugins/message.class.php');

$smarty = new smartySetup(array("user.xml"), FALSE);
$dona   = new dona();
$employee = new employee();
$msg    = new message();
$process_result =  TRUE;

function doing_normal_type_leave_cancellation($time_table_entries, $sign_check = FALSE){
    $employee_obj = new employee();
    foreach($time_table_entries as $tt_entry){
            $flg = TRUE;
            $r_id = $tt_entry;
            while($flg){
                $flg = FALSE;
                $relations = $employee_obj->check_relations_in_timetable_for_leave($r_id);
                if($relations){  //check have substitute exist or not?
                    //if replaced replaced employee is not signed in and the date of leave is not passed
                    $time_for_date = explode('.', $relations[0]['time_from']);
                    $time_for_date_time = strtotime($relations[0]['date']. ' '. str_pad($time_for_date[0], 2, '0', STR_PAD_LEFT).':'.str_pad($time_for_date[1], 2, '0', STR_PAD_RIGHT).':00');
                    if($sign_check){
                        $report_sign_flag = 0;
                        if($relations[0]['employee'] != '' && $relations[0]['customer'] != '')
                            $report_sign_flag = $employee_obj->chk_employee_rpt_signed($relations[0]['employee'], $relations[0]['customer'], $relations[0]['date']);
                        if(($report_sign_flag == 0 && $time_for_date_time > time()) || $relations[0]['employee'] == '')
                            $employee_obj->delete_timetable_leave_byRelationID($r_id);  //delete substitutes record
                    }else if($time_for_date_time > time() || $relations[0]['employee'] == '')
                        $employee_obj->delete_timetable_leave_byRelationID($r_id);  //delete substitutes record
                    $r_id = $relations[0]['id'];
                    $flg = TRUE;
                }
            }
        }
}

$privileges_mc = $employee->get_privileges($_SESSION['user_id'], 3);//setting message center previlege

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'leave_slot_remove'){
    
    //echo "<pre>".print_r($_REQUEST, 1)."</pre>";
    $vikarie_delete_flag = $_REQUEST['vikarie_delete'] == 0 ? FALSE : TRUE;
    $leave_id = $_REQUEST['leave_id'];//leave_id = leave_id
    $slot_id = $_REQUEST['slot_id'];
    $slot_employee = $_REQUEST['employee'];
    $slot_date = $_REQUEST['date'];
    $slot_tfrom = $_REQUEST['tfrom'];
    $slot_tto = $_REQUEST['tto'];
    
    $today_date_time = strtotime(date('Y-m-d H:i:s'). ' -90 days');
    $slot_start_date_time = strtotime($slot_date." ".$slot_tfrom);
    $minute_diff = round(($today_date_time - $slot_start_date_time) / 60,2);
    $is_past_slot = $minute_diff > 0 ? TRUE : FALSE;
    
   // $report_sign_flag = $employee->chk_employee_rpt_signed($slot_employee,$slot_date);
    $report_sign_flag = 0;
    $leave_slot = $employee->customer_employee_slot_details($slot_id);
    if(!empty($leave_slot) && $leave_slot['employee'] != '' && $leave_slot['customer'] != ''){
        if ($employee->chk_employee_rpt_signed($leave_slot['employee'], $leave_slot['customer'], $leave_slot['date']) == 1){
            $report_sign_flag = 1;
        }
    }
    
    if($is_past_slot){
        $process_result =  FALSE;
        $msg->set_message('fail', 'date_is_passed_cant_cancel_leave');
    }
    else if($report_sign_flag == 1){
        $process_result =  FALSE;
        $msg->set_message('fail', 'employee_already_signed_cant_cancel_leave');
    }
    else{
        $relations = $employee->check_employed_relations_in_timetable_for_leave($slot_id);
        if(empty($relations)){
            $id_for_updates_status = '\''.$slot_id.'\'';
            $rslt = $employee->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
            if($vikarie_delete_flag)
                doing_normal_type_leave_cancellation(array($slot_id));
            $employee->skip_a_time_slot_from_leave_slot($leave_id, $slot_tfrom, $slot_tto);
        }elseif(!empty($relations)){
            $report_sign_flag = 0;
            if($vikarie_delete_flag){
                $pending_child_slots = array( array('id' => $slot_id, 'employee' => $slot_employee, 'customer' => $leave_slot['customer'], 'date' => $leave_slot['date']));
                while(!empty($pending_child_slots)){
                    $sub_root = array_pop($pending_child_slots);
                    $sub_childs = $employee->check_relations_in_timetable_for_leave($sub_root['id']);
                    if(!empty($sub_childs)){
                        $pending_child_slots = array_merge($pending_child_slots,$sub_childs);
                    }elseif($sub_root['employee'] != '' && $sub_root['customer'] != ''){
                        $report_sign_flag = $employee->chk_employee_rpt_signed($sub_root['employee'],$sub_root['customer'], $sub_root['date']);
                    }
                }
            }
            if($report_sign_flag == 1){     //that checks the final substitute is signed the report or not?
                $process_result =  FALSE;
                $msg->set_message('fail', 'substitue_already_signed');
                //$employee->delete_sick_slots_n_update_relative_slot($slot_id);
                //$employee->skip_a_time_slot_from_leave_slot($leave_id, $slot_tfrom, $slot_tto);
            }else{
                $id_for_updates_status = '\''.$slot_id.'\'';
                $rslt = $employee->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
                if($vikarie_delete_flag)
                    doing_normal_type_leave_cancellation(array($slot_id));
                $employee->skip_a_time_slot_from_leave_slot($leave_id, $slot_tfrom, $slot_tto);
            }
            
        } 

        if($process_result){
            $msg->set_message('success', 'leave_remove_success');
            $process_result = TRUE;
        }
    }
    
    
}
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'back_to_work'){
    if ($privileges_mc['leave_approval'] != 1){
        $process_result = FALSE;
        $msg->set_message('fail', 'leave_edit');
    }
    if($process_result && isset($_REQUEST['edited_from']) && $_REQUEST['edited_from'] != ""){
        $employee->leave_id     = $_REQUEST['leave_id']; //leave_id = group_id
        $leave_group_data = $employee->get_leave_details_byID($employee->leave_id);
        $L_st_date = $leave_group_data[0]['leave_date'];
        $L_end_date = $leave_group_data[count($leave_group_data)-1]['leave_date'];
        $L_st_time = $leave_group_data[0]['time_from'];
        $L_end_time = $leave_group_data[count($leave_group_data)-1]['time_to'];
        $lId = $_REQUEST['id']; //leave ID
        $Slot_ID = $_REQUEST['slotid'];
        
        $edited_from = $dona->time_to_sixty($_REQUEST['edited_from']);
        if($edited_from == 0 && intval($_REQUEST['edited_from']) != 0)
            $edited_from = 24;
       // $leave_data = $employee->get_leave_details_byID($lId, FALSE);
        $slot_data = $employee->customer_employee_slot_details($Slot_ID);
       // $Sdate = $_REQUEST['date'];
        $Sdate = $slot_data['date'];
        $slot_st_time = $slot_data['time_from'];
        $slot_end_time = $slot_data['time_to'];
        $slot_employee = $slot_data['employee'];
        $slot_customer = $slot_data['customer'];
        
        if($L_end_date == $Sdate)
            $is_last_day_of_leave = TRUE;
        else
            $is_last_day_of_leave = FALSE;
        
        if($edited_from <= $slot_st_time){
            $process_result = FALSE;
            $msg->set_message('fail', 'time_from_must_greater_than_slot_time_from');
        }else if($is_last_day_of_leave && $edited_from >= $L_end_time){
            $process_result = FALSE;
            $msg->set_message('fail', 'time_from_must_less_than_leave_time_from');
        }else{
            if($employee->chk_employee_rpt_signed($slot_employee, $slot_customer, $L_st_date) == 0 && $employee->chk_employee_rpt_signed($slot_employee, $slot_customer, $L_end_date) == 0){
                $employee->begin_transaction();
                //update time table entries
                $tt_update_result = $employee->update_timetable_leave_slot($Slot_ID, $edited_from);
                
                $total_success = TRUE;
                
                //get cloned slot details
                $related_slot = $employee->check_relations_in_timetable_for_leave($Slot_ID);
                //create balance slot with this employee if cloned slot have no employee
                if(!empty($related_slot) && $related_slot[0]['employee'] == ''){
                    if(!$dona->customer_employee_slot_add($slot_employee, $slot_customer, $Sdate, $edited_from, $slot_end_time, $_SESSION['user_id'], $slot_data['fkkn'], $slot_data['type'], '',$slot_data['comment'])){
                        $total_success = FALSE;
                    }
                    
                    if($total_success){
                        $process_params_for_cloned_slot = array(
                            'employee'  => $related_slot[0]['employee'],
                            'customer'  => $related_slot[0]['customer'],
                            'date'      => $related_slot[0]['date'],
                            'time_from' => $slot_st_time,
                            'time_to'   => $edited_from,
                            'type'      => $related_slot[0]['type'],
                            'fkkn'      => $related_slot[0]['fkkn']);
                        $total_success = $employee->update_slot_details($related_slot[0]['id'], $process_params_for_cloned_slot);
                    }
                }
                
                if($total_success){
                    $process_date = strtotime($Sdate);
                    $j = 0;
                    while($process_date <= strtotime($L_end_date)){
                        $tt_result = TRUE;
                        $leave_result = TRUE;
                        
                        $calculate_time_from = $calculated_time_to = '';
                        $temp_trigger_condition = TRUE;
                        
                        if($j == 0 && $process_date == strtotime($L_end_date)){
                            $calculate_time_from = $slot_end_time;
                            $calculated_time_to = $L_end_time;
                        }else if($j == 0){
                            $calculate_time_from = $slot_end_time;
                            $calculated_time_to = 24;
                        }else if($j != 0 && $process_date < strtotime($L_end_date)){
                            $calculate_time_from = 0;
                            $calculated_time_to = 24;
                        }else if($j != 0 && $process_date == strtotime($L_end_date)){
                            $calculate_time_from = 0;
                            $calculated_time_to = $L_end_time;
                        }
                        else
                            $temp_trigger_condition = FALSE;
                        
                        if($temp_trigger_condition){
                            $tt_result  = $employee->delete_timetable_leave_entries_btwn_from_to($slot_employee,date('Y-m-d',$process_date),$calculate_time_from,$calculated_time_to);
                        }

                        //update leave table entries
                        if($j == 0){
                            $leave_result = $employee->update_leave_table_time_to($lId, $edited_from);
                        }else if($j != 0){
                            $leave_result = $employee->delete_leave_entries_by_group_id($employee->leave_id, date('Y-m-d',$process_date));
                        }

                        $total_success = ($total_success && $leave_result && $tt_result && $tt_update_result) ? TRUE : FALSE ;

                        if(!$total_success)
                            break;

                        $process_date = strtotime('+1 day', $process_date);
                        $j++;
                    }
                }
                
                if($total_success){
                    $process_result = TRUE;
                    $employee->commit_transaction();
                    $msg->set_message('success', 'back_to_work_success');
                }else{
                    $process_result = FALSE;
                    $employee->rollback_transaction();
                    $msg->set_message('fail', 'back_to_work_fail');
                }
            }
            else{
                $process_result = FALSE;
                $msg->set_message('fail', 'employee_already_signed_cant_edit_leave');
            }
        }
    }
}


$return_obj = new stdClass();
$return_obj->result = $process_result;
$message_data = $msg->show_message_data_for_gritter();
$return_obj->message = $message_data->message;
$return_obj->session_status = $session_check;
echo json_encode($return_obj);
?>