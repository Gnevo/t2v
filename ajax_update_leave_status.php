<?php
require_once('class/setup.php');
require_once('class/employee.php');
require_once ('class/leave.php');
require_once ('plugins/message.class.php');
require_once('class/dona.php');
$smarty = new smartySetup(array("messages.xml","button.xml"), FALSE);
$employee= new employee();
$obj_leave = new leave();
$msg = new message();

$employee->leave_id = $_POST['id'];
$employee->leave_status = $_POST['status'];
$date_from = substr($_POST['date_from'],0,10);
$time_from = substr($_POST['date_from'], 11);
$date_to = substr($_POST['date_to'],0,10);
$time_to = substr($_POST['date_to'], 11);

//echo "<script>alert(\"".$time_from.'-'.$time_to."\")</script>";
//$url_val = "navigatePage('".$smarty->url."message/center/leave/";
//if($_POST['year'])
//    $url_val .= $_POST['year']."/";
//
//if($_POST['month'])
//    $url_val .= $_POST['month']."/";
//
//$url_val .= "')";
$privileges_mc = $employee->get_privileges($_SESSION['user_id'], 3);//setting message center previlege

$obj_return = new stdClass();
$obj_return->result = FALSE;

$dont_show_message = FALSE;
$obj_return->post = $_POST;
if(isset($_POST['action']) && trim($_POST['action']) == 'APPROVE_ALL'){
    if ($privileges_mc['approve_all_leave'] != 1 || !isset($_POST['month']) || !isset($_POST['year']) || trim($_POST['month']) == '' || trim($_POST['year']) == ''){
        $msg->set_message('fail', 'permission_denied');
        $obj_return->result = FALSE;
        $obj_return->message = $msg->show_message();
        echo json_encode($obj_return);
        exit();
    }
    // exit();

    $dona = new dona();
    // $leave_list = $dona->get_all_employee_leave(NULL, NULL, NULL, NULL,NULL,'NO_LIMIT');
    // $leave_list = $dona->get_all_employee_leave(NULL, NULL, NULL, NULL, 0, "SHOW_ALL");
    $leave_list = $dona->get_all_employee_leave(trim($_POST['year']), trim($_POST['month']), NULL, NULL, 0, "SHOW_ALL");
    if(!empty($leave_list)){
        $leaveGroupIds = array();
        foreach($leave_list as $l){
            if($l['gID'] != '') $leaveGroupIds[] = $l['gID'];
        }

        $obj_return->processed_gids = $leaveGroupIds;
        if(!empty($leaveGroupIds)){
            if($employee->update_leave_status_by_groupIds($leaveGroupIds, 1)){
                $msg->set_message('success', 'leave_accept_success');
                $obj_return->result = TRUE;
                $dont_show_message = TRUE;
            }
            else {
                $msg->set_message('fail', 'leave_accept_fail');
            }
        }
    }

    
}
else{
    if($_POST['status'] == '2'){
        if ($privileges_mc['leave_rejection'] != 1){
            $msg->set_message('fail', 'permission_denied');
            $obj_return->result = FALSE;
            $obj_return->message = $msg->show_message();
            //        echo '|||'.$msg->show_message();
            echo json_encode($obj_return);
            exit();
        }
        $vikarie_delete_flag = $_POST['vikarie_delete'] == 0 ? FALSE : TRUE;
        $cur_time = strtotime(date('Y-m-d H:i:s'). ' -90 days');    //curdate changed to curdate-3month
        $leave_start_time = mktime(intval($time_from, 10), ($time_from - intval($time_from, 10))*100, 0, substr($date_from,5,2), substr($date_from,8,2), substr($date_from,0,4));
        
        //check employee signed or not
        $process_date = strtotime($date_from);
        $leave_entries = array();
        $j = 0;
        while ($process_date <= strtotime($date_to)) {
            if ($j == 0 && $process_date == strtotime($date_to))
                $leave_entries = array_merge($leave_entries, $obj_leave->get_employee_leave_slots($_POST['employee'], $date_from, $time_from, $time_to));
            else if ($j == 0)
                $leave_entries = array_merge($leave_entries, $obj_leave->get_employee_leave_slots($_POST['employee'], $date_from, $time_from, 24));
            else if ($j != 0 && $process_date < strtotime($date_to))
                $leave_entries = array_merge($leave_entries, $obj_leave->get_employee_leave_slots($_POST['employee'], date('Y-m-d', $process_date), 0, 24));
            else if ($j != 0 && $process_date == strtotime($date_to))
                $leave_entries = array_merge($leave_entries, $obj_leave->get_employee_leave_slots($_POST['employee'], $date_to, 0, $time_to));
            
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
        
        if($cur_time >= $leave_start_time){
            $msg->set_message('fail', 'date_is_passed_cant_cancel_leave');
        } else if($report_sign_flag == 1){
            $msg->set_message('fail', 'employee_already_signed_cant_cancel_leave');
        } else if($vikarie_report_sign_flag == 1){
            $msg->set_message('fail', 'substitue_already_signed');
        } else {
            if($employee->update_leave_status($_POST['employee'], $date_from, $date_to, $time_from, $time_to, $vikarie_delete_flag)){
                $msg->set_message('success', 'leave_reject_success');
                $leave_details=$employee->get_leave_details_byID($_POST['id']);
                /*$smarty->assign('approve_name', $leave_details[0]['appr_empname']);
                $smarty->assign('comment', $leave_details[0]['comment']);
                $smarty->assign('approve_date', $leave_details[0]['appr_date']);
                $smarty->assign('status', $_POST['status']);
                $smarty->display('ajax_update_leave_status.tpl');*/
                
                $obj_return->result = TRUE;
                $obj_return->leave_details = $leave_details[0];
                $obj_return->status = $_POST['status'];
            } else{
                $msg->set_message('fail', 'leave_reject_fail');
                $obj_return->result = FALSE;
            }
        }
    }
    else{
        if ($privileges_mc['leave_approval'] != 1){
            $msg->set_message('fail', 'permission_denied');
            //echo '|||'.$msg->show_message();
            $obj_return->result = FALSE;
            $obj_return->message = $msg->show_message();
            echo json_encode($obj_return);
            exit();
        }
        
        if($employee->update_leave_status($_POST['employee'], $date_from,$date_to,$time_from,$time_to)){
            $msg->set_message('success', 'leave_accept_success');
            $leave_details=$employee->get_leave_details_byID($_POST['id']);
            /*$smarty->assign('approve_name', $leave_details[0]['appr_empname']);
            $smarty->assign('comment', $leave_details[0]['comment']);
            $smarty->assign('approve_date', $leave_details[0]['appr_date']);
            $smarty->assign('status', $_POST['status']);
            $smarty->display('ajax_update_leave_status.tpl');*/
            
            $obj_return->result = TRUE;
            $obj_return->leave_details = $leave_details[0];
            $obj_return->status = $_POST['status'];
        }
    }
}
if(!$dont_show_message)
    $obj_return->message = $msg->show_message();
echo json_encode($obj_return);
//echo '|||'.$msg->show_message();
?>