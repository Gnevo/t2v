<?php
require_once('class/setup.php');
require_once('class/customer.php');
require_once ('class/employee.php');
require_once ('class/leave.php');
require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
require_once ('class/sms.php');
require_once ('class/dona.php');

$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml","messages.xml","mail.xml"), FALSE);
$date = new datecalc();
$employee = new employee();
$customer = new customer();
$msg = new message();
$leave = new leave();
$obj_dona = new dona();
//setting the menu
$smarty->assign('menu', array('mainmenu' => 1, 'submenu' => 1));
$smarty->assign('message', $msg->show_message()); //messages of actions

// assigning  sort by first or last name
$smarty->assign('sort_by_name', $_SESSION['company_sort_by']);


/*if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {

    $query_string = explode('&', $_SERVER['QUERY_STRING']);
    $year_week = $query_string[0];
    
    if (!empty($query_string[1])) {
        $employee_username = $query_string[1];
    }
    $week_position = 8;
    if (!empty($query_string[2])) {
        $week_position = $query_string[2];
    }
} else {

    $year_week = date('Y') . '|' . date('W');
    $week_position = 8;
}*/
   
$action = $_REQUEST['action'];

if($action == 'slots'){
  
    $id = $_REQUEST['id'];
    $emp = $_REQUEST['employee'];
    $time_from = $_REQUEST['time_from'];
    $time_to = $_REQUEST['time_to'];
    //$date = $_REQUEST['start_date'];
    $smarty->assign('action',$action);
    $smarty->assign('leave_employee',$emp);
    $smarty->assign('leave_time_from',$time_from);
    $smarty->assign('leave_time_to',$time_to);
    
    $data = array();
    $slots = array();
    $j = 0;
    $date = strtotime($_REQUEST['start_date']);
    
    while($date <= strtotime($_REQUEST['end_date'])){
        
        if($j == 0 && $date == strtotime($_REQUEST['end_date'])){

            
            $data = $leave->employee_get_leave_slot($_REQUEST['employee'],$_REQUEST['start_date'],$_REQUEST['time_from'],$_REQUEST['time_to']);
        }
        else if($j == 0){
            $data = $leave->employee_get_leave_slot($_REQUEST['employee'],$_REQUEST['start_date'],$_REQUEST['time_from'],24);
        }
        else if($j != 0 && $date < strtotime($_REQUEST['end_date'])){
            $data = $leave->employee_get_leave_slot($_REQUEST['employee'],date('Y-m-d',$date),0,24);
        }
        else if($j != 0 && $date == strtotime($_REQUEST['end_date'])){
            $data = $leave->employee_get_leave_slot($_REQUEST['employee'],$_REQUEST['end_date'],0,$_REQUEST['time_to']);
        }

        $slots = array_merge($slots,$data);
        
        $date = strtotime('+1 day', $date);
        $j++;
    }
        
        
        
    //$slots = $leave->employee_get_leave_slot($emp, $date, $time_from, $time_to);
    /*foreach($slots as $slot){
        echo "<script>alert(\"".$slot['id']."\")</script>";
        echo "<script>alert(\"".$slot['status']."\")</script>";
    }*/
    if($slots)
        $smarty->assign('slots' , $slots);
    $smarty->assign('start_date' , $_REQUEST['start_date']);
    $smarty->assign('end_date' , $_REQUEST['end_date']);
}
else if($action == 'avail'){
    $id = $_REQUEST['id'];
    $emp = $_REQUEST['employee'];
    $cust = $_REQUEST['customer'];
    $time_from = $_REQUEST['time_from'];
    $time_to = $_REQUEST['time_to'];
    $date = $_REQUEST['date'];
    $smarty->assign('action',$action);
    $smarty->assign('leave_employee',$_REQUEST['leave_employee']);
    $smarty->assign('leave_time_from',$_REQUEST['leave_time_from']);
    $smarty->assign('leave_time_to',$_REQUEST['leave_time_to']);
    $smarty->assign('start_date' , $_REQUEST['start_date']);
    $smarty->assign('end_date' , $_REQUEST['end_date']);
    
    if($_REQUEST['sms_process_status'])
        $datas = $employee->get_sms_processed_users ($id);
    else    
        $datas = $employee->get_available_users($cust, $time_from, $time_to, $date);
    //echo "<pre>\n".print_r($datas, 1)."</pre>";
    $users = array();
    $sms_data = array();
    
    $smarty->assign('sms_customer', $cust);
    $smarty->assign('sms_date', $date);
    $smarty->assign('sms_id', $id);
    $smarty->assign('sms_process_status', $_REQUEST['sms_process_status']);
    //echo "<script>alert(\"".$time_from."\")</script>";
    //echo "<script>alert(\"".$time_to."\")</script>";
    
    $smarty->assign('sms_slot', str_pad($time_from, 5, '0',STR_PAD_LEFT).'-'.str_pad($time_to, 5, '0',STR_PAD_LEFT).'('.($time_to-$time_from).'h)' );
    $users = array();
    foreach($datas as $data){
        
        if($data['username'] != $_REQUEST['leave_employee']){
            //echo "<script>alert(\"".$id."\")</script>";
            //echo "<script>alert(\"".$emp."\")</script>";
            $sms_det = $leave->get_leave_sms_details($id, $data['username']);
            if($sms_det){
                if($sms_det['status'] == '3'){
                    $smarty->assign('sms_status', '3');
                }
                $sms_data = array('sms_id' => $sms_det['slot'], 'sms_send' => substr($sms_det['send_time'], 6, 10) , 'sms_status' => $sms_det['status'], 'sms_receive' => substr($sms_det['receive_time'], 6, 10));
                $data = array_merge($data, $sms_data);
            }
            if($data['mobile'] != ''){
                $length_mobile_display = (strlen($data['mobile'])-5)/2;
                $temp_mobile = '';
                $pos = 5;
                for($j=0;$j<$length_mobile_display;$j++){
                    $temp_mobile = $temp_mobile." ".substr($data['mobile'], $pos,2);
                    $pos = $pos +2;
                }
                $data['mobile'] = "+46".substr($data['mobile'], 0,3) . " " . substr($data['mobile'], 3,2)." ".$temp_mobile;
            }
            $users[] = $data;
        }
    }
    if($users)
        $smarty->assign('users' , $users);
}
else if($action == 'action_sms'){
    
    $status = 0;
    $sms_message = '%0A'.$smarty->translate['customer'].' : ' . $_REQUEST['customer'].'%0A'.$smarty->translate['date'].' : '. $_REQUEST['date'] . '%0A'.$smarty->translate['shift'].' : ' . $_REQUEST['slot_time'];
    if($_REQUEST['message'])
        $sms_message .= '%0A'.urldecode($_REQUEST['message']);
    $sms_message .= '%0A'.$smarty->translate['answer_yes'];
     
    $obj_sms = new sms($sms_message);
    //$obj_sms->setCallback($smarty->url.'sms_callback.php');
//    $obj_sms->setCallback('http://demo.arioninfotech.co.in/t2v/sms_callback.php');
//    $obj_sms->setTag($_REQUEST['id']);
    $users = explode('-', $_REQUEST['users']);
    if($_REQUEST['conf'] == 1){
        if($_REQUEST['sender'] == 0)
            $status = 0;
        else if($_REQUEST['sender'] == 1)
            $status = 4;
    }else if($_REQUEST['conf'] == 0){
        if($_REQUEST['sender'] == 1 && $_REQUEST['rejection'] == 1){
            $status = 8;
        }else if($_REQUEST['sender'] == 1){
            $status = 6;
        }else if($_REQUEST['rejection'] == 1){
            $status = 7;
        }else if($_REQUEST['sender'] == 0 && $_REQUEST['rejection'] == 0){
            $status = 5;
        }
    }
    array_pop($users);
    $sms_process_flag = TRUE;
    //echo "<pre>".print_r($users, 1)."</pre>";
    if(!empty($users)){
        foreach($users as $user){
            $mobile = $leave->get_employee_mobile($user);
            $obj_sms->clearRecipients();
            if($mobile){
                $leave->begin_transaction();
                $tag_id = $leave->update_sms_records($_REQUEST['id'], $user, $status);
                //echo "<pre>".print_r($leave->query_error_details, 1)."</pre>";
                $obj_sms->addRecipient($mobile);

                if($tag_id == FALSE){
                    echo "SHaju Fals";
                    $leave->rollback_transaction();
                    continue;
                }else{
                    echo "SHaju TRUE";
                    $leave->commit_transaction ();
                }
                echo "SHaju OK";
                $obj_sms->setTag($tag_id);
                if(!$obj_sms->send())
                    $sms_process_flag = FALSE;
                
                echo "SHaju AGAIN TRUE";
            }
        }
    }
    
    if($sms_process_flag) {
//        if($_REQUEST['conf'] == 0){    
//            $employee->employee_add_to_slot($_REQUEST['id'], $users[0], $_SESSION['user_id']);
//        }        
        echo "<script>alert(\"".$smarty->translate['message_sent']."\")</script>";
        echo "<script>loadAvailUsers('".$smarty->url."ajax_leave_sms.php?date=".$_REQUEST['date']."&id=".$_REQUEST['id']."&time_from=".substr($_REQUEST['slot_time'],0,5)."&time_to=".substr($_REQUEST['slot_time'],6,5)."&customer=".$_REQUEST['customer']."&action=avail&leave_employee=".$_REQUEST['leave_employee']."&leave_time_from=".$_REQUEST['leave_time_from']."&leave_time_to=".$_REQUEST['leave_time_to']."')</script>";
    }
}

else if($action == 'accept'){
    $flag = 1;
    $sms_message = '%0A'.$smarty->translate['customer'].' : ' . $_REQUEST['customer'].'%0A'.$smarty->translate['date'].' : '. $_REQUEST['date'] . '%0A'.$smarty->translate['shift'].' : ' . $_REQUEST['slot_time'];
    if($_REQUEST['message'])
        $sms_message .= '%0A'.$_REQUEST['message'];
    if($_REQUEST['sender'] == 1){
        $sms_message .= '%0A'.$smarty->translate['shift_accepted'];
        $obj_sms = new sms($sms_message);
        if($mobile = $leave->get_employee_mobile($_REQUEST['employee'])){
            $obj_sms->addRecipient($mobile);
        }
        if(!$obj_sms->send())
            $flag = 0;
    }
    if($_REQUEST['rejection'] == 1){
        $sms_message .= '%0A'.$smarty->translate['shift_rejected'];
        $leave->tables = array('leave_sms');
        $leave->fields = array('employee');
        $leave->conditions = array('AND', 'slot = ?', 'employee != ?');
        $leave->condition_values = array($_REQUEST['id'], $_REQUEST['employee']);
        $leave->query_generate();
        $datas = $leave->query_fetch();
        $obj_sms = new sms($sms_message);
        foreach($datas as $data){
            if($mobile = $leave->get_employee_mobile($data['employee'])){
                $obj_sms->addRecipient($mobile);
            }
        }
        if($flag == 1){
            if(!$obj_sms->send())
                $flag = 0;
        }
    }
    if($flag == 1){
        $leave->begin_transaction();
        $slot_det = $employee->customer_employee_slot_details($_REQUEST['id']);
        if($leave->update_sms_records_accept($_REQUEST['id'], $_REQUEST['employee'], 1, $slot_det['status'])){
            
                $leave->commit_transaction();
                echo "<script>alert(\"".$smarty->translate['status_updated']."\")</script>";
                echo "<script>loadLeaveSlots('".$smarty->url."ajax_leave_sms.php?start_date=".$_REQUEST['start_date']."&end_date=".$_REQUEST['end_date']."&date=".$_REQUEST['date']."&employee=".$_REQUEST['leave_employee']."&time_from=".$_REQUEST['leave_time_from']."&time_to=".$_REQUEST['leave_time_to']."&action=slots')</script>";
                
            
        }else{
               $leave->rollback_transaction();
        }
    }    
}
else if($action == 'delete'){
    $obj_dona->begin_transaction();
    if($obj_dona->customer_employee_slot_remove($_REQUEST['id'])){

            $obj_dona->commit_transaction();
            
            echo "<script>loadLeaveSlots('".$smarty->url."ajax_leave_sms.php?start_date=".$_REQUEST['start_date']."&end_date=".$_REQUEST['end_date']."&date=".$_REQUEST['date']."&employee=".$_REQUEST['leave_employee']."&time_from=".$_REQUEST['leave_time_from']."&time_to=".$_REQUEST['leave_time_to']."&action=slots')</script>";


    }else{
           $obj_dona->rollback_transaction();
    }
}
//setting layout and page
$smarty->display('ajax_leave_sms.tpl');
?>