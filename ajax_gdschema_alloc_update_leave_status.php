<?php
/**
 * Author: Shamsu
 * for: actions on leaves from gdschema alloc window 
*/

require_once ('class/setup.php');
require_once ('class/employee.php');
require_once ('class/dona.php');
require_once ('class/leave.php');
require_once ('plugins/message.class.php');
$smarty = new smartySetup(array("messages.xml","button.xml", "gdschema.xml"), FALSE);
$employee= new employee();
$msg = new message();
$obj_leave = new leave();

//$employee->leave_id = $_POST['id'];
$leave_data = $employee->get_leave_details_byID($_REQUEST['id'], FALSE);
$employee->leave_id = $leave_data[0]['gid'];    //leave id changed to it'z group id
$employee->leave_status = $_REQUEST['status'];
//exit();

$privileges_mc = $employee->get_privileges($_SESSION['user_id'], 3);//setting message center previlege

if($_POST['status'] == '2'){
    if ($privileges_mc['leave_rejection'] != 1){
        $msg->set_message('fail', 'permission_denied');
        exit();
    }
    $vikarie_delete_flag = $_POST['vikarie_delete'] == 0 ? FALSE : TRUE;
    $leave_group_data = $employee->get_leave_details_byID($employee->leave_id);
    $st_date = $leave_group_data[0]['leave_date'];
    $end_date = $leave_group_data[count($leave_group_data)-1]['leave_date'];
    $st_time = $leave_group_data[0]['time_from'];
    $end_time = $leave_group_data[count($leave_group_data)-1]['time_to'];
    
    $Ldatefrom = $st_date;
    $Ldateto = $end_date;
    $Ltime_from = $st_time;
    $Ltime_to = $end_time;
    $Lemployee = $leave_group_data[0]['emp_id'];
    
    $cur_time = strtotime(date('Y-m-d H:i:s'). ' -90 days');    //curdate changed to curdate-3month
//    $leave_start_time = mktime(intval($Ltime_from, 10), ($Ltime_from - intval($Ltime_from, 10))*100, 0, substr($Ldate,5,2), substr($Ldate,8,2), substr($Ldate,0,4));
    $leave_start_time = mktime(intval($Ltime_from, 10), ($Ltime_from - intval($Ltime_from, 10))*100, 0, substr($Ldatefrom,5,2), substr($Ldatefrom,8,2), substr($Ldatefrom,0,4));
    
    //check employee signed or not
    $process_date = strtotime($Ldatefrom);
    $leave_entries = array();
    $j = 0;
    while ($process_date <= strtotime($Ldateto)) {
        if ($j == 0 && $process_date == strtotime($Ldateto))
            $leave_entries = array_merge($leave_entries, $obj_leave->get_employee_leave_slots($Lemployee, $Ldatefrom, $Ltime_from, $Ltime_to));
        else if ($j == 0)
            $leave_entries = array_merge($leave_entries, $obj_leave->get_employee_leave_slots($Lemployee, $Ldatefrom, $Ltime_from, 24));
        else if ($j != 0 && $process_date < strtotime($Ldateto))
            $leave_entries = array_merge($leave_entries, $obj_leave->get_employee_leave_slots($Lemployee, date('Y-m-d', $process_date), 0, 24));
        else if ($j != 0 && $process_date == strtotime($Ldateto))
            $leave_entries = array_merge($leave_entries, $obj_leave->get_employee_leave_slots($Lemployee, $Ldateto, 0, $Ltime_to));
        
        $process_date = strtotime('+1 day', $process_date);
        $j++;
    }
    $report_sign_flag = $vikarie_report_sign_flag = 0;
    if(!empty($leave_entries)){
        //check employee signed or not
        foreach($leave_entries as $lentry){
            if ($employee->chk_employee_rpt_signed($lentry['employee'], $lentry['customer'], $lentry['date']) == 1){
                $report_sign_flag = 1;
                break;
            }
        }
        
        //check vikaries signed or not
        if ($vikarie_delete_flag && $report_sign_flag == 0) {
            foreach($leave_entries as $lentry){
                $pending_child_slots = array( array('id' => $lentry['id'], 'employee' => $lentry['employee'], 'customer' => $lentry['customer'], 'date' => $lentry['date']));
                while(!empty($pending_child_slots)){
                    $sub_root = array_pop($pending_child_slots);
                    $sub_childs = $employee->check_relations_in_timetable_for_leave($sub_root['id']);
                    if(!empty($sub_childs)){
                        $pending_child_slots = array_merge($pending_child_slots,$sub_childs);
                    }elseif($sub_root['employee'] != '' && $sub_root['customer'] != ''){
                        $vikarie_report_sign_flag = $employee->chk_employee_rpt_signed($sub_root['employee'],$sub_root['customer'], $sub_root['date']);
                        if($vikarie_report_sign_flag == 1) break;
                    }
                }
                
                if($vikarie_report_sign_flag == 1) break;
            }
        }
    }
    
    
    if($cur_time >= $leave_start_time)
        $msg->set_message('fail', 'date_is_passed_cant_cancel_leave');
//    else if($employee->chk_employee_rpt_signed($Lemployee, $Ldatefrom) == 1 || $employee->chk_employee_rpt_signed($Lemployee, $Ldateto) == 1)
    else if($report_sign_flag == 1)
            $msg->set_message('fail', 'employee_already_signed_cant_cancel_leave');
//    else if(!$employee->chk_employee_relation_rpt_signed($Lemployee, $Ldatefrom, $Ldateto, $Ltime_from, $Ltime_to))
    else if($vikarie_report_sign_flag == 1)
            $msg->set_message('fail', 'substitue_already_signed');
    else{
        if($employee->update_leave_status($Lemployee, $Ldatefrom, $Ldateto, $Ltime_from, $Ltime_to, $vikarie_delete_flag))
                $msg->set_message('success', 'leave_reject_success');
        else
                $msg->set_message('fail', 'leave_reject_fail');
    }
    /*if($cur_time < $leave_start_time){
//        if($employee->chk_employee_rpt_signed($Lemployee, $Ldate) == 0){
        if($employee->chk_employee_rpt_signed($Lemployee, $Ldatefrom) == 0 && $employee->chk_employee_rpt_signed($Lemployee, $Ldateto) == 0){
//            if($employee->chk_employee_relation_rpt_signed($Lemployee, $Ldate,$Ldate,$Ltime_from,$Ltime_to)){
            if($employee->chk_employee_relation_rpt_signed($Lemployee, $Ldatefrom,$Ldateto,$Ltime_from,$Ltime_to)){
//                $result = $employee->update_leave_status_by_ID($Lemployee, $Ldate, $Ltime_from, $Ltime_to);
                if($employee->update_leave_status($Lemployee, $Ldatefrom, $Ldateto, $Ltime_from, $Ltime_to, $vikarie_delete_flag))
                        $msg->set_message('success', 'leave_reject_success');
                else
                        $msg->set_message('fail', 'leave_reject_fail');
            }else
                $msg->set_message('fail', 'substitue_already_signed');
        }else
            $msg->set_message('fail', 'employee_already_signed_cant_cancel_leave');
    }else
        $msg->set_message('fail', 'date_is_passed_cant_cancel_leave');*/
}
else if($_POST['status'] == '1'){
//    $result = $employee->update_leave_status_by_ID();
    if ($privileges_mc['leave_approval'] != 1){
        $msg->set_message('fail', 'permission_denied');
        exit();
    }
    if($employee->update_leave_status())
        $msg->set_message('success', 'leave_accept_success');
    else
        $msg->set_message('fail', 'leave_accept_fail');
}
else if($_REQUEST['status'] == '-1'){
    if ($privileges_mc['leave_approval'] != 1){
        $msg->set_message('fail', 'leave_edit');
        exit();
    }
    if(isset($_REQUEST['edited_from']) && $_REQUEST['edited_from'] != ""){
        $dona = new dona();
        
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
//        $leave_data = $employee->get_leave_details_byID($lId, FALSE);
        $slot_data = $employee->customer_employee_slot_details($Slot_ID);
//        $Sdate = $_REQUEST['date'];
        $Sdate = $slot_data['date'];
        $slot_st_time = $slot_data['time_from'];
        $slot_end_time = $slot_data['time_to'];
        $slot_employee = $slot_data['employee'];
        $slot_customer = $slot_data['customer'];
        
//        $cur_time = strtotime(date('Y-m-d H:i:s'));
//        $leave_start_datetime = mktime(intval($L_st_time, 10), ($L_st_time - intval($L_st_time, 10))*100, 0, substr($L_st_date,5,2), substr($L_st_date,8,2), substr($L_st_date,0,4));
//        $leave_end_datetime = mktime(intval($L_end_time, 10), ($L_end_time - intval($L_end_time, 10))*100, 0, substr($L_end_date,5,2), substr($L_end_date,8,2), substr($L_end_date,0,4));

        if($L_end_date == $Sdate)
            $is_last_day_of_leave = TRUE;
        else
            $is_last_day_of_leave = FALSE;
        
        if($edited_from <= $slot_st_time){
            $msg->set_message('fail', 'time_from_must_greater_than_slot_time_from');
        }else if($is_last_day_of_leave && $edited_from >= $L_end_time){
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
                            /*$tt_slot_ids= $employee->get_timetable_leave_entries_id($slot_employee,date('Y-m-d',$process_date),$calculate_time_from,$calculated_time_to);
                            if(!empty($tt_slot_ids)){
                                //get cloned slot details
                                $related_slot = $employee->check_relations_in_timetable_for_leave($tt_slot_ids);
                                
                                $tt_result  = $employee->delete_timetable_leave_entries_btwn_from_to($slot_employee,date('Y-m-d',$process_date),$calculate_time_from,$calculated_time_to);
                            }*/
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
                    $employee->commit_transaction();
                    $msg->set_message('success', 'back_to_work_success');
                }else{
                    $employee->rollback_transaction();
                    $msg->set_message('fail', 'back_to_work_fail');
                }
            }
            else
                $msg->set_message('fail', 'employee_already_signed_cant_edit_leave');
        }
        exit();
    }
    /*$smarty->assign('lId', $_GET['id']);
    $smarty->assign('lDate', $_GET['date']);
    $smarty->assign('lEmployee', $_GET['employee']);
    $emp_data = $employee->get_employee_detail($_GET['employee']);
    $smarty->assign('lEmployeeName', $emp_data['first_name']. ' '. $emp_data['last_name']);
    $smarty->assign('lTfrom', $_GET['t_from']);
    $smarty->assign('lTto', $_GET['t_to']);
    $smarty->display('extends:layouts/ajax_popup.tpl|ajax_gdschema_alloc_update_leave_status.tpl');*/
}
?>