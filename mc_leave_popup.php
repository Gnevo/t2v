<?php
require_once ('class/setup.php');
require_once ('class/employee.php');
require_once ('class/leave.php');
require_once ('configs/config.inc.php');
require_once ('plugins/message.class.php');
$smarty = new smartySetup(array('gdschema.xml', 'month.xml', 'button.xml', 'messages.xml'),FALSE);
$employee = new employee();
$msg = new message();
$obj_leave = new leave();

global $leave_type;
$group_id = $_REQUEST['gid'];

$return_obj = new stdClass();

if(isset($_REQUEST['action']) && ($_REQUEST['action'] == 'leave_remove' || $_REQUEST['action'] == 'leave_slot_remove_multiple')){
    $vikarie_delete_flag = $_REQUEST['vikarie_delete'] == 0 ? FALSE : TRUE;
    
    //get leave slots between two time ranges to check if signed with that slot customer
    //$report_sign_flag = $employee->chk_employee_rpt_signed($_REQUEST['user'], $_REQUEST['date']);
    if($_REQUEST['action'] == 'leave_remove') {
        $_REQUEST['date_to'] = $_REQUEST['date'];
    } else {
        $_REQUEST['date_to'] = isset($_REQUEST['date_to']) ? $_REQUEST['date_to'] : $_REQUEST['date'];
    }
    $sel_date = $_REQUEST['date'];
    //$obj_leave->begin_transaction();
    $employee_leave_groups = $obj_leave->get_employee_leave_by_groupid($_REQUEST['gid']);
    $group_from_date = date('Y-m-d', strtotime($employee_leave_groups[0]['From_date']));
    $group_to_date = date('Y-m-d', strtotime($employee_leave_groups[0]['To_date']));
    if((strtotime($group_from_date) <= strtotime($sel_date)) && (strtotime($group_to_date) >= strtotime($sel_date)) && (strtotime($group_from_date) <= strtotime($_REQUEST['date_to'])) && (strtotime($group_to_date) >= strtotime($_REQUEST['date_to']))) {

        $action_datas = array();
        while (strtotime($sel_date) <= strtotime($_REQUEST['date_to'])) {
            $_REQUEST['date'] = $sel_date;
            $report_sign_flag = 0;
            $leave_slots = $obj_leave->get_employee_leave_slots($_REQUEST['user'], $_REQUEST['date'], $_REQUEST['tfrom'], $_REQUEST['tto']);
            $action_datas[$sel_date] = array();
            if(!empty($leave_slots)){
                foreach($leave_slots as $lslot){
                    if ($employee->chk_employee_rpt_signed($lslot['employee'], $lslot['customer'], $lslot['date']) == 1){
                        $report_sign_flag = 1;
                        break;
                    }
                }
            }
            if($vikarie_delete_flag && $report_sign_flag == 0){
                if (!$employee->chk_employee_relation_rpt_signed($_REQUEST['user'], $_REQUEST['date'], $_REQUEST['date'], $_REQUEST['tfrom'], $_REQUEST['tto'])){
                    $report_sign_flag = 2;
                }
            }
            $today_date_time = strtotime(date('Y-m-d H:i:s'). ' -90 days');
            $slot_start_date_time = strtotime($_REQUEST['date']." 00:00:00");
            $minute_diff = round(($today_date_time - $slot_start_date_time) / 60,2);
            $is_past_slot = $minute_diff > 0 ? TRUE : FALSE;
            if($report_sign_flag == 1)
                $msg->set_message('fail', 'employee_already_signed_cant_cancel_leave');
            else if($report_sign_flag == 2)
                $msg->set_message('fail', 'substitue_already_signed');
            else if($is_past_slot)
                    $msg->set_message('fail', 'date_is_passed_cant_cancel_leave');
            /*else if($employee->remove_leave_from_leave_tbl($_REQUEST['id'])){       //remove from leave table
                //get related timeslots from timetable in which it's status is 2
                $time_table_entries = $employee->get_timetable_leave_entries_id($_REQUEST['user'],$_REQUEST['date'],$_REQUEST['tfrom'],$_REQUEST['tto']);
                $id_for_updates_status = '\'' . implode('\', \'', $time_table_entries) . '\'';
               
                $rslt = $employee->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
                if($vikarie_delete_flag)
                    doing_normal_type_leave_cancellation($time_table_entries, TRUE);
                $msg->set_message('success', 'leave_remove_success');
                
                $return_obj->process_result = TRUE;
            }*/
            else {
                $time_table_entries = $employee->get_timetable_leave_entries_id($_REQUEST['user'],$_REQUEST['date'],$_REQUEST['tfrom'],$_REQUEST['tto']);
                $action_datas[$sel_date]['time_table_entries'] = array();
                $has_error = FALSE;
                if(!empty($time_table_entries)){
                    //juz creating dona class object for deleting leave slot only if vikarie slot didn't delete
                    /* 2 function moved to leave class by dona
                    if(!$vikarie_delete_flag){
                        require_once ('class/dona.php');
                        $obj_dona = new dona();
                    }*/
                    foreach($time_table_entries as $slot_id){
                        $relations = $employee->check_employed_relations_in_timetable_for_leave($slot_id);
                        $action_datas[$sel_date]['time_table_entries'][$slot_id]['relations'] = array();
                        if(empty($relations)){
                            /*$id_for_updates_status = '\''.$slot_id.'\'';
                            $rslt = $employee->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
                            if($vikarie_delete_flag)
                                doing_normal_type_leave_cancellation(array($slot_id));
                            $employee->skip_a_time_slot_from_leave_slot($leave_id, $slot_tfrom, $slot_tto);*/
                            
                            //Edited @ 2015-08-04
                            //when deleting vikarie original slot(leave slot)  will become active slot(Green)
                            //if not deleting vikarie - Original slot(leave slot) will be delete and keep vikarie without changes
                            /*dona commented
                            if($vikarie_delete_flag){
                                $id_for_updates_status = '\''.$slot_id.'\'';
                                $rslt = $obj_leave->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
                                doing_normal_type_leave_cancellation(array($slot_id));
                            }else{
                                $obj_leave->customer_employee_slot_remove_for_leave($slot_id);
                            }*/
                        } elseif (!empty($relations)){
                            $report_sign_flag = 0;
                            $action_datas[$sel_date]['time_table_entries'][$slot_id]['relations'] = $relations;
                            $action_datas[$sel_date]['time_table_entries'][$slot_id]['relations']['pending_child_slots'] = array();
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
                                $action_datas[$sel_date]['time_table_entries'][$slot_id]['relations']['pending_child_slots'] = $pending_child_slots;
                            }
                            $action_datas[$sel_date]['time_table_entries'][$slot_id]['relations']['report_sign_flag'] = $report_sign_flag;
                            if($report_sign_flag == 1){     //that checks the final substitute is signed the report or not?
                                $msg->set_message('fail', 'substitue_already_signed');
                                $return_obj->process_result = FALSE;
                                $has_error = TRUE;
                                //$employee->delete_sick_slots_n_update_relative_slot($slot_id);
                                //$employee->skip_a_time_slot_from_leave_slot($leave_id, $slot_tfrom, $slot_tto);
                            }else{
                                /*$id_for_updates_status = '\''.$slot_id.'\'';
                                $rslt = $employee->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
                                if($vikarie_delete_flag)
                                    doing_normal_type_leave_cancellation(array($slot_id));
                                $employee->skip_a_time_slot_from_leave_slot($leave_id, $slot_tfrom, $slot_tto);*/
                                /*dona commented
                                if($vikarie_delete_flag){
                                    $id_for_updates_status = '\''.$slot_id.'\'';
                                    $rslt = $obj_leave->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
                                    doing_normal_type_leave_cancellation(array($slot_id));
                                } else {
                                    $obj_leave->customer_employee_slot_remove_for_leave($slot_id);
                                }*/
                            }
                        } 
                    }
                }
                $action_datas[$sel_date]['leave'] = array('group_id' => $group_id, 'employee' => $_REQUEST['user']);
                $action_datas[$sel_date]['leave']['id'] = (isset($_REQUEST['id']) ? $_REQUEST['id'] : 0);
                /*if(!$has_error){
                    if(isset($_REQUEST['id'])) {
                        if($obj_leave->remove_leave_from_leave_tbl($_REQUEST['id'])){       
                            //remove from leave table
                            $msg->set_message('success', 'leave_remove_success');
                            $return_obj->process_result = TRUE;
                        }
                    } else {
                        if($obj_leave->remove_leave_from_leave_tbl_by_group($group_id, $_REQUEST['user'], $sel_date)){       
                            //remove from leave table
                            $msg->set_message('success', 'leave_remove_success');
                            $return_obj->process_result = TRUE;
                        }
                    }
                }*/
            }
            $sel_date = date('Y-m-d', strtotime($sel_date .' +1 day'));
        }
        /*if (!$report_sign_flag && !$is_past_slot && !$has_error) {
            //$employee->commit_transaction();
            $obj_leave->commit_transaction();
        } else {
            //$employee->rollback_transaction();
            $obj_leave->rollback_transaction();
        }*/
        //print_r($action_datas);
        if (!$report_sign_flag && !$is_past_slot && !$has_error) {
            if(!empty($action_datas)) {
                $process_flag = true;
                //$obj_leave->begin_transaction();
                foreach ($action_datas as $sel_date => $action_data) {
                    if(!empty($action_data['time_table_entries'])){
                        foreach($action_data['time_table_entries'] as $slot_id => $slots){
                            $id_for_updates_status = '\''.$slot_id.'\'';
                            if(empty($slots['relations'])){
                                if($vikarie_delete_flag){
                                    $rslt = $obj_leave->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
                                    doing_normal_type_leave_cancellation(array($slot_id));
                                }else{
                                    $obj_leave->customer_employee_slot_remove_for_leave($slot_id);
                                }
                            } elseif (!empty($slots['relations'])){
                                if(!$slots['relations']['report_sign_flag']){
                                    if($vikarie_delete_flag){
                                        $rslt = $obj_leave->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
                                        doing_normal_type_leave_cancellation(array($slot_id));
                                    } else {
                                        $obj_leave->customer_employee_slot_remove_for_leave($slot_id);
                                    }
                                }
                            }
                            
                        }
                    }
                    if(isset($action_data['leave']['id']) && $action_data['leave']['id']) {
                        if($obj_leave->remove_leave_from_leave_tbl($_REQUEST['id'])){       
                            //remove from leave table
                            $msg->set_message('success', 'leave_remove_success');
                            $return_obj->process_result = TRUE;
                        } else {
                            $process_flag = false;
                        }
                    } else {
                        if($obj_leave->remove_leave_from_leave_tbl_by_group($action_data['leave']['group_id'], $action_data['leave']['employee'], $sel_date)){       
                            //remove from leave table
                            $msg->set_message('success', 'leave_remove_success');
                            $return_obj->process_result = TRUE;
                        } else {
                            $process_flag = false;
                        }
                    }
                }
                /*if($process_flag) {
                    $obj_leave->commit_transaction();
                } else {
                    $obj_leave->rollback_transaction();
                }*/
            }
        }
    } else {
        $msg->set_message('fail', 'invalid_date');
        $return_obj->process_result = TRUE;
    }
    
    $return_obj->message = $msg->show_message();
    //$smarty->assign('message', $msg->show_message());
}
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'leave_slot_remove'){
    //echo "<pre>".print_r($_REQUEST, 1)."</pre>";
    $vikarie_delete_flag = $_REQUEST['vikarie_delete'] == 0 ? FALSE : TRUE;
    $leave_id = $_REQUEST['leave_id'];
    $slot_id = $_REQUEST['slot_id'];
    $slot_employee = $_REQUEST['employee'];
    $slot_date = $_REQUEST['date'];
    $slot_tfrom = $_REQUEST['tfrom'];
    $slot_tto = $_REQUEST['tto'];
    
    $today_date_time = strtotime(date('Y-m-d H:i:s'). ' -90 days');
    $slot_start_date_time = strtotime($slot_date." ".$slot_tfrom);
    $minute_diff = round(($today_date_time - $slot_start_date_time) / 60,2);
    $is_past_slot = $minute_diff > 0 ? TRUE : FALSE;
    
    $return_obj->process_result = TRUE;
    
    //$report_sign_flag = $employee->chk_employee_rpt_signed($slot_employee,$slot_date);
    $report_sign_flag = 0;
    $leave_slot = $employee->customer_employee_slot_details($slot_id);
    if(!empty($leave_slot) && $leave_slot['employee'] != '' && $leave_slot['customer'] != ''){
        if ($employee->chk_employee_rpt_signed($leave_slot['employee'], $leave_slot['customer'], $leave_slot['date']) == 1){
            $report_sign_flag = 1;
        }
    }
    
    if($is_past_slot){
        $msg->set_message('fail', 'date_is_passed_cant_cancel_leave');
        $return_obj->process_result = FALSE;
    }else if($report_sign_flag == 1){
        $msg->set_message('fail', 'employee_already_signed_cant_cancel_leave');
        $return_obj->process_result = FALSE;
    }else{
        //juz creating dona class object for deleting leave slot only if vikarie slot didn't delete
        if(!$vikarie_delete_flag){
            require_once ('class/dona.php');
            $obj_dona = new dona();
        }
        
        $relations = $employee->check_employed_relations_in_timetable_for_leave($slot_id);
        if(empty($relations)){
            /*$id_for_updates_status = '\''.$slot_id.'\'';
            $rslt = $employee->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
            if($vikarie_delete_flag)
                doing_normal_type_leave_cancellation(array($slot_id));
            $employee->skip_a_time_slot_from_leave_slot($leave_id, $slot_tfrom, $slot_tto);*/
            
            //Edited @ 2015-08-04
            //when deleting vikarie original slot(leave slot)  will become active slot(Green)
            //if not deleting vikarie - Original slot(leave slot) will be delete and keep vikarie without changes
            if($vikarie_delete_flag){
                $id_for_updates_status = '\''.$slot_id.'\'';
                $rslt = $employee->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
                doing_normal_type_leave_cancellation(array($slot_id));
            }else{
                $obj_dona->customer_employee_slot_remove($slot_id);
            }
                
            $employee->skip_a_time_slot_from_leave_slot($leave_id, $slot_tfrom, $slot_tto);
        }
        elseif(!empty($relations)){
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
                $msg->set_message('fail', 'substitue_already_signed');
                $return_obj->process_result = FALSE;
                //$employee->delete_sick_slots_n_update_relative_slot($slot_id);
                //$employee->skip_a_time_slot_from_leave_slot($leave_id, $slot_tfrom, $slot_tto);
            }else{
                /*$id_for_updates_status = '\''.$slot_id.'\'';
                $rslt = $employee->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
                if($vikarie_delete_flag)
                    doing_normal_type_leave_cancellation(array($slot_id));
                $employee->skip_a_time_slot_from_leave_slot($leave_id, $slot_tfrom, $slot_tto);*/
                if($vikarie_delete_flag){
                    $id_for_updates_status = '\''.$slot_id.'\'';
                    $rslt = $employee->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
                    doing_normal_type_leave_cancellation(array($slot_id));
                } else {
                    $obj_dona->customer_employee_slot_remove($slot_id);
                }
                
                $employee->skip_a_time_slot_from_leave_slot($leave_id, $slot_tfrom, $slot_tto);
            }
        } 
        //$return_obj->process_result = TRUE;
        /*if($is_past_slot && empty($relations)){
            echo 'condition 1';
        }elseif(!$is_past_slot && empty($relations)){
            echo 'condition 2';
            //$id_for_updates_status = '\''.$slot_id.'\'';
            //$rslt = $employee->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
            //doing_normal_type_leave_cancellation(array($slot_id));
        }elseif(!empty($relations)){
            echo 'condition 3';
            $report_sign_flag = 0;
            $pending_child_slots = array( array('id' => $slot_id, 'employee' => $slot_employee, 'customer' => ''));
            while(!empty($pending_child_slots)){
                $sub_root = array_pop($pending_child_slots);
                $sub_childs = $employee->check_relations_in_timetable_for_leave($sub_root['id']);
                if(!empty($sub_childs)){
                    $pending_child_slots = array_merge($pending_child_slots,$sub_childs);
                }elseif($sub_root['employee'] != ""){
                    $report_sign_flag = $employee->chk_employee_rpt_signed($sub_root['employee'],$slot_date);
                    //echo "checked slot: ". $sub_root['id'];
                }
                //echo "<pre>".print_r($pending_child_slots, 1)."</pre>";
            }
            if($report_sign_flag == 1){     //that checks the final substitute is signed the report or not?
                $msg->set_message('fail', 'substitue_already_signed_cant_cancel_leave');
                //$employee->delete_sick_slots_n_update_relative_slot($slot_id);
            }else{
                echo 'else case of condition 3';
                //$id_for_updates_status = '\''.$slot_id.'\'';
                //$rslt = $employee->update_timetable_status_when_leave_cancel_byID($id_for_updates_status);  //update timetable status
                //doing_normal_type_leave_cancellation(array($slot_id));
            }
        }*/
    }
    
    $return_obj->message = $msg->show_message();
    //$smarty->assign('message', $msg->show_message());
}

$leave_details = $employee->get_leave_details_byID($group_id);
for($i = 0 ; $i<count($leave_details) ; $i++){
    $this_emp = $leave_details[$i]['emp_id'];
    $this_date = $leave_details[$i]['leave_date'];
    $this_tfrom = $leave_details[$i]['time_from'];
    $this_tto = $leave_details[$i]['time_to'];
    $leave_details[$i]['day_slots'] = $employee->employee_work_slots_day($this_emp, $this_date, $this_tfrom, $this_tto);
}
//$smarty->assign('emp_alloc', $_SESSION['user_id']);
//$smarty->assign('emp_role', $_SESSION['user_role']); // role of employee logged in
$return_obj->leave_date_from = $leave_details[0]['leave_date'];
$return_obj->leave_date_to = $leave_details[(count($leave_details) -1)]['leave_date'];
$return_obj->leave_type = $leave_type;
$return_obj->leave_details = $leave_details;
$return_obj->employee_name = $leave_details[0]['leave_employee'];
echo json_encode($return_obj);
//$smarty->assign("leave_type", $leave_type);  // take leave type from config.inc.php
//$smarty->assign('leave_details', $leave_details);
//$smarty->assign('employee_name', $leave_details[0]['leave_employee']);

//$smarty->display('extends:layouts/ajax_popup.tpl|mc_leave_popup.tpl');

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
                        
                    //}else if($time_for_date_time > time() || $relations[0]['employee'] == ''){
                    }else {
                        //this else if block commented on 2015-11-20 - bcoz substitute slot alwayz need to be delete
                        $employee_obj->delete_timetable_leave_byRelationID($r_id);  //delete substitutes record
                    }
                    $r_id = $relations[0]['id'];
                    $flg = TRUE;
                }
            }
        }
}
?>