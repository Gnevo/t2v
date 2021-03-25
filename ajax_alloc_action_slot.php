<?php
/*
 * action page for time slots
 * changing type of the slots to travel,break and oridinary
 * adding time slot by drag and drop
 * removing skills(then it removes the user also)
 * removing employee (also skill if it is associated)
 * removing customer(also skill if it is associated)
 * removing the whole slot
 * adding manual time slot
 * adding skill
 * adding customer
 * adding employee
 */
require_once('class/setup.php');
require_once ('class/dona.php');
require_once ('class/customer.php');
require_once ('class/employee.php');
require_once ('class/leave.php');
require_once ('plugins/message.class.php');
require_once ('class/user.php');
require_once ('class/mail.php');
$msg = new message();
$obj_cust = new customer();
$obj_emp = new employee();
$obj_leave = new leave();
$dona = new dona();
$smarty = new smartySetup(array("mail.xml", "gdschema.xml"), FALSE);
$obj_user = new user();
$url = '';
if ($_REQUEST['employee'] != '' && $_REQUEST['customer'] != ''){
    $url = $smarty->url . 'gdschema_slot_manage.php?slot=' . $_REQUEST['id'] . '&customer=' . $_REQUEST['customer'] . '&employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
    $url_alloc = $smarty->url . 'gdschema_alloc.php?customer=' . $_REQUEST['customer'] . '&employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
}else if ($_REQUEST['employee'] == '' && $_REQUEST['customer'] != ''){
    $url = $smarty->url . 'gdschema_slot_manage.php?slot=' . $_REQUEST['id'] . '&customer=' . $_REQUEST['customer'] . '&date=' . $_REQUEST['date'];
    $url_alloc = $smarty->url . 'gdschema_alloc.php?customer=' . $_REQUEST['customer'] . '&date=' . $_REQUEST['date'];
}else if ($_REQUEST['employee'] != '' && $_REQUEST['customer'] == ''){
    $url = $smarty->url . 'gdschema_slot_manage.php?slot=' . $_REQUEST['id'] . '&employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
    $url_alloc = $smarty->url . 'gdschema_alloc.php?employee=' . $_REQUEST['employee'] . '&date=' . $_REQUEST['date'];
}


//changing slot type to travell, break, normal
if ($_REQUEST['action'] == 'type') {//adding type
        
        $slot_from = $_REQUEST['slot_from'];
        $slot_to = $_REQUEST['slot_to'];
        $time_from = $dona->time_to_sixty($_REQUEST['time_from']);
        $time_to = $dona->time_to_sixty($_REQUEST['time_to']);
        if ($time_to == 0) $time_to = 24;
        if ($time_from >= $slot_from && $time_from <= $slot_to && $time_to >= $slot_from && $time_to <= $slot_to) {
            
            $slot_details = $dona->customer_employee_slot_details($_REQUEST['id']);
            $process_params = array(
                                'employee'      =>  $slot_details['employee'],
                                'customer'      =>  $slot_details['customer'], 
                                'date'          =>  $slot_details['date'], 
                                'type'          =>  $_REQUEST['type'], 
                                'time_from'     =>  $time_from, 
                                'time_to'       =>  $time_to); 

            if($obj_emp->findout_slot_alteration_bug($process_params, array($_REQUEST['id']))){
                if ($dona->employee_slot_type_update($_REQUEST['id'], $_REQUEST['type'], $time_from, $time_to))
                    echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');</script>';
            } else {
                echo '<script>loadContentSlot(\'' . $url . '\')</script>';
            }
            
        } else {
            $msg->set_message('fail', 'entered_time_not_within_slot');
            echo '<script>loadContentSlot(\'' . $url . '\')</script>';
        }
}

else if ($_REQUEST['action'] == 'edit_duration') {
    $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
    $slot_from =  $dona->time_to_sixty($_REQUEST['slot_from']);
    $slot_to =  $dona->time_to_sixty($_REQUEST['slot_to']);
    if($slot_to == 0){
        $slot_to = 24.00;
    }
    $resultant_flag = FALSE;
    if(floatval($slot_from) >= floatval($slot_to)){
        if($slot_det['employee'] == "" || $slot_det['employee'] == NULL){
            $obj_emp->begin_transaction();
            if($obj_emp->customer_employee_slot_edit($_REQUEST['id'],$slot_from,24.00)){
                $dona->begin_transaction();
                if($dona->customer_employee_slot_add($slot_det['employee'], $slot_det['customer'], date('Y-m-d', strtotime('+1 day', strtotime($slot_det['date']))) , 0.00, $slot_to, $slot_det['alloc_emp'], $slot_det['fkkn'], $slot_det['type'],'')){
                    $msg->set_message('success', 'duration_editted_sucessfully');
                    $dona->commit_transaction();
                    $obj_emp->commit_transaction();
                    $resultant_flag = TRUE;
                    echo '<script>loadContentSlot(\'' . $url . '\')</script>';
                }else{
                     $dona->rollback_transaction();
                     $obj_emp->rollback_transaction();
                     $msg->set_message('fail', 'duration_editting_failed');
                     echo '<script>loadContentSlot(\'' . $url . '\')</script>';
                }
            }else{
                $obj_emp->rollback_transaction();
                $msg->set_message('fail', 'duration_editting_failed');
                echo '<script>loadContentSlot(\'' . $url . '\')</script>';
            }
        }else{
            if($obj_emp->is_valid_slot_for_edit_duration($slot_det['employee'], $slot_from, 24.00, $slot_det['date'],$_REQUEST['id'])){
                 $obj_emp->begin_transaction();
                if($obj_emp->customer_employee_slot_edit($_REQUEST['id'],$slot_from,24.00)){
                    if($obj_emp->is_valid_slot($slot_det['employee'], 0.00,$slot_to, date('Y-m-d', strtotime('+1 day', strtotime($slot_det['date']))))){
                        
                        if($dona->customer_employee_slot_add($slot_det['employee'], $slot_det['customer'], date('Y-m-d', strtotime('+1 day', strtotime($slot_det['date']))) , 0.00, $slot_to, $slot_det['alloc_emp'], $slot_det['fkkn'], $slot_det['type'])){
                            $msg->set_message('success', 'duration_editted_sucessfully');
                            $obj_emp->commit_transaction();
                            $resultant_flag = TRUE;
                            echo '<script>loadContentSlot(\'' . $url . '\')</script>';
                        }else{
                           $obj_emp->rollback_transaction();
                           $msg->set_message('fail', 'duration_editting_failed');
                           echo '<script>loadContentSlot(\'' . $url . '\')</script>';
                        }
                    }else{
                        $obj_emp->rollback_transaction();
                        $msg->set_message('fail', 'duration_editting_failed');
                        echo '<script>loadContentSlot(\'' . $url . '\')</script>';
                    }
                     
                }else{
                    $obj_emp->rollback_transaction();
                    $msg->set_message('fail', 'duration_editting_failed');
                    echo '<script>loadContentSlot(\'' . $url . '\')</script>';
                }
            }else{
                 $msg->set_message('fail', 'duration_editting_failed');
                 echo '<script>loadContentSlot(\'' . $url . '\')</script>';
            }
        }
    }else{
        if($slot_det['employee'] == "" || $slot_det['employee'] == NULL){
            if($obj_emp->customer_employee_slot_edit($_REQUEST['id'],$slot_from,$slot_to)){
                $msg->set_message('success', 'duration_editted_sucessfully');
                $resultant_flag = TRUE;
                echo '<script>loadContentSlot(\'' . $url . '\')</script>';
            }
        }else{
            if($obj_emp->is_valid_slot_for_edit_duration($slot_det['employee'], $slot_from, $slot_to, $slot_det['date'],$_REQUEST['id'])){
                if($obj_emp->customer_employee_slot_edit($_REQUEST['id'],$slot_from,$slot_to)){
                     $msg->set_message('success', 'duration_editted_sucessfully');
                     $resultant_flag = TRUE;
                     echo '<script>loadContentSlot(\'' . $url . '\')</script>';
                }
            }else{
                 $msg->set_message('fail', 'duration_editting_failed');
                 echo '<script>loadContentSlot(\'' . $url . '\')</script>';
            }
        }
    }
    if($resultant_flag && isset($_REQUEST['atl_param']) && !empty($_REQUEST['atl_param']))
                $obj_emp->saveATL($_REQUEST['atl_param']['employee'], $_REQUEST['atl_param']['date'], $_REQUEST['atl_param']['timefrom'], $_REQUEST['atl_param']['timeto'], $_REQUEST['atl_param']['customer'], $_REQUEST['atl_param']['exceed_hours']);
}

//splitting time slot
else if ($_REQUEST['action'] == 'split') {//adding type
    
    $slot_from  = $_REQUEST['slot_from'];
    $slot_to    = $_REQUEST['slot_to'];
    $time_from  = $dona->time_to_sixty($_REQUEST['time_from']);
    $time_to    = $dona->time_to_sixty($_REQUEST['time_to']);
    if ($time_to == 0) { $time_to = 24; }
    if ($time_from >= $slot_from && $time_from <= $slot_to && $time_to >= $slot_from && $time_to <= $slot_to) {
        if ($dona->employee_slot_split($_REQUEST['id'], $time_from, $time_to)) {
            $msg->set_message('success', 'slot_splitted_successfully');
//            echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');</script>'; //commented by smsdn on 2015-02-13
        }  else
            $msg->set_message('fail', 'slot_split_fail');
    } else {
        $msg->set_message('fail', 'not_within_slot');
//        echo '<script>loadContentSlot(\'' . $url . '\')</script>';
    }
    
}

//splitting time slot multiple
else if ($_REQUEST['action'] == 'splitmultiple') {//adding type
    $flag = true;
    $ids = explode('-', $_REQUEST['id']);
    $time_from  = $dona->time_to_sixty($_REQUEST['time_from']);
    $time_to    = $dona->time_to_sixty($_REQUEST['time_to']);
    if ($time_to == 0) { $time_to = 24; }
    foreach ($ids as $id) {
        $slot = $obj_emp->customer_employee_slot_details($id);
        $slot_from  = $slot['time_from'];
        $slot_to    = $slot['time_to'];
        if ($time_from >= $slot_from && $time_from <= $slot_to && $time_to >= $slot_from && $time_to <= $slot_to) {
            if (!$dona->employee_slot_split($id, $time_from, $time_to)) {
                $flag = false;
            }
        }
    }
    if ($flag) {
        $msg->set_message('success', 'slot_splitted_successfully');
    } else {
        $msg->set_message('fail', 'slot_split_fail');
    }
}

//splitting time slot multiple
else if ($_REQUEST['action'] == 'interestedin') {//adding type
    $flag = true;
    $emp_username = $_SESSION['user_id'];
    $cust_username = NULL;
    $employee = $obj_emp->get_employee_detail($emp_username);
    $employee_name = $employee['last_name'] . ' ' . $employee['first_name'];
    if($_SESSION['company_sort_by'] == 1){
        $employee_name = $employee['first_name'] . ' ' . $employee['last_name'];
    }
    $ids = explode('-', $_REQUEST['id']);
    $slot_details = '';
    foreach ($ids as $id) {
        $slot = $obj_cust->customer_employee_slot_details($id);
        $slot_details .= $smarty->translate['date'] . ': ' .$slot['date'] . ', ' . $smarty->translate['customer'] . ': ' . $slot['customer'] . ', ' . $smarty->translate['slot'] . ': ' . $slot['slot'] . '(' . $slot['slot_hour'] .')<br/>';
        $cust_username = $slot['customer'];
    }
    $employees = $obj_leave->get_employees_in_charge($emp_username, $cust_username, FALSE);
    if($employees['username']) {
        $obj_mail = new mail();
        $obj_mail->root_id = 0;
        $obj_mail->status = 0;
        $obj_mail->subject = $smarty->translate['slot_interest_in_subject'];
        $obj_mail->message = $smarty->translate['slot_interest_in_message'];
        $obj_mail->message .= '<br/>' . $smarty->translate['requested_by'] . ' ' . $employee_name;
        $obj_mail->message .= '<br/>' . $slot_details;
        $obj_mail->from = $_SESSION['user_id'];
        $obj_mail->to = $employees['username'];
        if(!$obj_mail->insert_mail(true)) {
            $flag = false;
        }
    } else if($employees['email']) {
        $mail_sub = $smarty->translate['slot_interest_in_subject'];
        $mail_msg = $smarty->translate['slot_interest_in_message'];
        $mail_msg .= '<br/>' . $smarty->translate['requested_by'] . ' ' . $employee_name;
        $mail_msg .= '<br/>' . $slot_details;
        $obj_mail = new SimpleMail($mail_sub, $mail_msg);
        $obj_mail->addSender("cirrus-noreplay@time2view.se");
        $obj_mail->addRecipient($employees['email'], trim($employees['name']));
        if(!$obj_mail->send()) {
            $flag = false;
        }
    }
    //send to self
    $obj_mail = new mail();
    $obj_mail->root_id = 0;
    $obj_mail->status = 0;
    $obj_mail->subject = $smarty->translate['slot_interest_in_subject'];
    $obj_mail->message = $smarty->translate['slot_interest_in_message'];
    $obj_mail->message .= '<br/>' . $smarty->translate['requested_by'] . ' ' . $employee_name;
    $obj_mail->message .= '<br/>' . $slot_details;
    $obj_mail->from = $_SESSION['user_id'];
    $obj_mail->to = $_SESSION['user_id'];
    if(!$obj_mail->insert_mail(true)) {
        $flag = false;
    }
    if ($flag) {
        $msg->set_message('success', 'slot_interest_successfully');
    } else {
        $msg->set_message('fail', 'slot_interest_fail');
    }
}

//adding time slot by drag and drop
else if ($_REQUEST['action'] == 'drop') {
    $employee_to_add = $_REQUEST['employee'];
    if($_SESSION['user_role'] == 3){
        $employee_to_add = $_SESSION['user_id'];
    }
    if ($dona->customer_employee_slot_add($employee_to_add, $_REQUEST['customer'], $_REQUEST['date'], $_REQUEST['time_from'], $_REQUEST['time_to'], $_REQUEST['emp_alloc'])) {

        echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');</script>';
    }
}
//adding slot by manual entry
else if ($_REQUEST['action'] == 'man_slot_entry') {
    //converting time to sixty
    $time_from = $dona->time_to_sixty($_REQUEST['time_from']);
    $time_to = $dona->time_to_sixty($_REQUEST['time_to']);
    if ($time_to == 0) {
        $time_to = 24;
    }
    $employee_to_add = $_REQUEST['employee'];
    if($_SESSION['user_role'] == 3){
        $employee_to_add = $_SESSION['user_id'];
    }
    if ($time_from >= $time_to) { //if the slot enters next day
        $cur_date = strtotime($_REQUEST['date'] . ' 00:00:00');
        $next_date = date('Y-m-d', ($cur_date + 24 * 3600));
        if ($obj_emp->is_valid_slot($employee_to_add, $time_from, 24, $_REQUEST['date']) && $obj_emp->is_valid_slot($employee_to_add, 0, $time_to, $next_date)) {
            //echo "<script>alert(\"1\")</script>";
            if ($dona->customer_employee_slot_add($employee_to_add, $_REQUEST['customer'], $_REQUEST['date'], $time_from, 24, $_REQUEST['emp_alloc'])) {

                if ($dona->customer_employee_slot_add($employee_to_add, $_REQUEST['customer'], $next_date, 0, $time_to, $_REQUEST['emp_alloc'])) {

                    echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');</script>';
                }
                else{
                    $msg->set_message('fail', 'insertion_failed');
                    echo '<script>loadContentSlot(\'' . $url . '\')</script>';
                }
            }else{
                $msg->set_message('fail', 'insertion_failed');
                echo '<script>loadContentSlot(\'' . $url . '\')</script>';
            }
        }else{
            $msg->set_message('fail', 'slot_collide');
            echo '<script>loadContentSlot(\'' . $url . '\')</script>';
        }
    } else {//if the time slot is on same day
        //checking the time is valid
        if ($obj_emp->is_valid_slot($employee_to_add, $time_from, $time_to, $_REQUEST['date'])) {
            if ($dona->customer_employee_slot_add($employee_to_add , $_REQUEST['customer'], $_REQUEST['date'], $time_from, $time_to, $_REQUEST['emp_alloc'])) {

                echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');</script>';
            }else{
                $msg->set_message('fail', 'insertion_failed');
                echo '<script>loadContentSlot(\'' . $url . '\')</script>';
            }
        } else {
            $msg->set_message('fail', 'slot_collide');
            echo '<script>loadContentSlot(\'' . $url . '\')</script>';
        }
    }
}

//removing employee (also skill if it is associated)
else if ($_REQUEST['action'] == 'emp_remove') {
   
    $slot_det = $dona->customer_employee_slot_details($_REQUEST['id']);
    if ($_REQUEST['employee'] != '' && $_REQUEST['customer'] != '') {

        if ($obj_emp->remove_from_slot($_REQUEST['id'], $_REQUEST['emp_alloc'])) {
            echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');</script>';
        }
    } else if ($_REQUEST['employee'] == '' || $_REQUEST['customer'] == '') {
        
        if ($slot_det['customer'] == '') {
            
            if ($dona->customer_employee_slot_remove($_REQUEST['id'])) {
                echo '<script>$("#chk_status").val("1");closePopup(\'' . $url_alloc . '\');</script>';
            }
        } else {
            if ($obj_emp->remove_from_slot($_REQUEST['id'], $_REQUEST['emp_alloc'])) {
                 echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');$("#have_updation").val("1");</script>';
                /* if ($slot_det['customer'] == '') {
                  if ($dona->customer_employee_skill_remove($_REQUEST['id'], $_REQUEST['emp_alloc'])) {
                  echo '<script>loadContentSlot(\'' . $url . '\')</script>';
                  }
                  } else {
                  echo '<script>loadContentSlot(\'' . $url . '\')</script>';
                  } */
            }
        }
    }
}

//removing customer (also skill if it is associated)
else if ($_REQUEST['action'] == 'cust_remove') {
    $slot_det = $obj_cust->customer_employee_slot_details($_REQUEST['id']);
    if ($_REQUEST['employee'] != '' && $_REQUEST['customer'] != '') {

        if ($obj_cust->remove_from_slot($_REQUEST['id'], $_REQUEST['emp_alloc'])) {
            echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');</script>';
        }
    } else if ($_REQUEST['employee'] == '' || $_REQUEST['customer'] == '') {
        if ($slot_det['employee'] == '') {
            if ($dona->customer_employee_slot_remove($_REQUEST['id'])) {
                echo '<script>$("#chk_status").val("1");closePopup(\'' . $url_alloc . '\');</script>';
            }
        } else {
            if ($obj_cust->remove_from_slot($_REQUEST['id'], $_REQUEST['emp_alloc'])) {
                echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');$("#have_updation").val("1");</script>';
                /*if ($slot_det['employee'] == '') {
                    if ($dona->customer_employee_skill_remove($_REQUEST['id'], $_REQUEST['emp_alloc'])) {
                        echo '<script>loadContentSlot(\'' . $url . '\')</script>';
                    }
                } else {
                    echo '<script>loadContentSlot(\'' . $url . '\')</script>';
                }*/
            }
        }
    }
}

//removing the whole slot
else if ($_REQUEST['action'] == 'slot_remove') {
    
    if ($dona->customer_employee_slot_remove($_REQUEST['id'])){
        $msg->set_message('success', 'slot_delete_success');
    }
    else {
        $msg->set_message('fail', 'slot_delete_failed');
    }
//    echo '<script>$("#chk_status").val("1");closePopup(\'' . $url_alloc . '\');</script>';
}

//Adding employee
else if ($_REQUEST['action'] == 'add_emp') {
        if ($_SESSION['user_role'] == 3){
            $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
            if ($slot_det['customer'] != '' && $slot_det['employee'] == ''){
                    $available_users = $obj_emp->get_available_users($slot_det['customer'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['date']);
                    if(!empty($available_users)){
                        $obj_emp->employee_add_to_slot($_REQUEST['id'], $_SESSION['user_id'], $_SESSION['user_id']);
                    }else{
                        $msg->set_message('fail', 'no_employee_available');
                    }
            }
        }else if(isset($_REQUEST['select_emp'])) 
            $obj_emp->employee_add_to_slot($_REQUEST['id'], $_REQUEST['select_emp'], $_SESSION['user_id']);
        
        echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');$("#have_updation").val("1");</script>';
}
//adding customer
else if ($_REQUEST['action'] == 'add_cust') {
    if ($obj_cust->customer_add_to_slot($_REQUEST['id'], $_REQUEST['select_cust'], $_SESSION['user_id']))
        echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');$("#have_updation").val("1");</script>';
}
//changing fkkn
else if ($_REQUEST['action'] == 'fkkn') {
     $_SESSION['fkkn'] = $_REQUEST['type'];
     if ($obj_emp->employee_fkkn_update($_REQUEST['id'], $_REQUEST['type']))
            echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');</script>';
}
//setting direct and prelimminary
else if ($_REQUEST['action'] == 'direct') {

     if ($obj_emp->employee_direct_preliminary_update($_REQUEST['id'], $_REQUEST['type']))
            echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');</script>';
}
//copying a slot

else if ($_REQUEST['action'] == 'copy') {
     
    //$_SESSION['copy_slot'] = array($_REQUEST['id']);
    $obj_user->add_to_temp_session(implode(",", array($_REQUEST['id'])), 1);
//    echo '<script>loadContentSlot(\'' . $url . '\')</script>';
}
//clear copying 
/*else if ($_REQUEST['action'] == 'clear_copy') {
    $_SESSION['copy_slot'] = '';
    echo '<script>loadContentSlot(\'' . $url . '\')</script>';
}*/
else if ($_REQUEST['action'] == 'swap') {
    if($_SESSION['swap'] == '')
        $_SESSION['swap'] = $_REQUEST['id'];
    else{
       if($_REQUEST['swap'] == 1){
            if($obj_emp->employee_swap($_SESSION['swap'],$_REQUEST['id'])){
               $msg->set_message('success', 'swap_success'); 
//               echo '<script>$("#chk_status").val("1");</script>';   //for request from gd_customer/gd_employee
//               echo '<script>$("#have_updation").val("1");</script>';//for request from gd_alloc_window
            }
            $_SESSION['swap'] = '';
       }else{
           $_SESSION['swap'] = $_REQUEST['id'];
       }
    }
//    echo '<script>loadContentSlot(\'' . $url . '\');</script>';
    //refresh popup information
//    $ch = curl_init();
//    if ($ch){
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_HEADER, 0);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
//
//        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
//        curl_setopt($ch, CURLOPT_COOKIESESSION, true );
//        curl_setopt($ch, CURLOPT_COOKIE, $_SERVER['HTTP_COOKIE']);
//        echo $response_body = curl_exec($ch);
//        curl_close($ch);
//    }
}
else if ($_REQUEST['action'] == 'copy_multiple') {
    unset($_SESSION['fkkn']);
    $days = explode('-', $_REQUEST['days']);
    array_pop($days);
    
    $obj_emp->copy_single_slot_to_multiple($_REQUEST['id'],$_REQUEST['from_week'], $_REQUEST['to_week'], $_REQUEST['from_option'], $_REQUEST['with_user'], $days);
    
    /*if($obj_emp->copy_single_slot_to_multiple($_REQUEST['id'],$_REQUEST['from_week'], $_REQUEST['to_week'], $_REQUEST['from_option'], $_REQUEST['with_user'], $days))
        echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\')</script>';
    else
        echo '<script>loadContentSlot(\'' . $url . '\')</script>';*/
}
else if ($_POST['action'] == 'edit_comment') {
    $slot_id = $_POST['id'];
    $slot_comment = trim($_POST['comment_text']);
    if($dona->edit_comment_slot($slot_id,$slot_comment)){
        echo "sucess";
    }else{
        echo "fail";
    }
}

else if ($_REQUEST['action'] == 'add_cust_save') {
    $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
        $process_params = array(
                            'employee'      =>  $slot_det['employee'],
                            'customer'      =>  $_REQUEST['cust_new'], 
                            'date'          =>  $slot_det['date'], 
                            'type'          =>  $slot_det['type'], 
                            'time_from'     =>  $slot_det['time_from'], 
                            'time_to'       =>  $slot_det['time_to']); 
        
        if($obj_emp->findout_slot_alteration_bug($process_params, array($_REQUEST['id']))){
            $obj_cust->customer_add_to_slot($_REQUEST['id'], $_REQUEST['cust_new'], $_SESSION['user_id'],$_REQUEST['comment']);
        }
        echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');$("#have_updation").val("1");</script>';
}

else if ($_REQUEST['action'] == 'add_emp_save') {
    if ($_SESSION['user_role'] == 3){
        $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
        if ($slot_det['customer'] != '' && $slot_det['employee'] == ''){
                
                $available_users = $obj_emp->get_available_users($slot_det['customer'], $slot_det['time_from'], $slot_det['time_to'], $slot_det['date']);
                if(!empty($available_users)){
                    $obj_emp->employee_add_to_slot($_REQUEST['id'], $_REQUEST['emp_new'], $_SESSION['user_id'],$_REQUEST['comment']);
                    echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');$("#have_updation").val("1");</script>';
                }else{
                    $msg->set_message('fail', 'no_employee_available');
                    echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');$("#have_updation").val("1");</script>';
                }
        }
       
    }else if(isset($_REQUEST['emp_new'])){
        $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['id']);
        $process_params = array(
                            'employee'      =>  $_REQUEST['emp_new'],
                            'customer'      =>  $slot_det['customer'], 
                            'date'          =>  $slot_det['date'], 
                            'time_from'     =>  $slot_det['time_from'], 
                            'time_to'       =>  $slot_det['time_to']);
       
        
        if($obj_emp->findout_slot_alteration_bug($process_params)){
            if($obj_emp->employee_add_to_slot($_REQUEST['id'], $_REQUEST['emp_new'], $_SESSION['user_id'],$_REQUEST['comment'])){
                
                echo '<script>$("#chk_status").val("1");loadContentSlot(\'' . $url . '\');$("#have_updation").val("1");</script>';
            }
                   
        }
    }
        

    
}

else if ($_POST['action'] == 'slot_approve_candg_new') {
    $slot_id = $_REQUEST['id'];
    $slot_comment = $_REQUEST['comment_text'];
    if($dona->approve_candg_slot($slot_id,$slot_comment)){
        echo "sucess";
    }else{
        echo "fail";
    }
}

?>