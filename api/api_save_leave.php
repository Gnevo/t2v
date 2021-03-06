<?php
session_name('t2v-cirrus');
session_start('t2v-cirrus');
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);

require_once ('class/setup.php');
require_once ('class/employee.php');
require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
require_once ('class/customer.php');
require_once ('class/sms.php');
require_once ('class/leave.php');

$smarty = new smartySetup(array("gdschema.xml", "month.xml","button.xml","messages.xml","mail.xml"),FALSE);
$employee   = new employee();
$message    = new message();
$date_calc  = new datecalc();
$obj_leave = new leave();

$slot_id            = $_REQUEST['slot_id'];
$employee_username  = $_REQUEST['employee'];
$leave_day_type     = $_REQUEST['leave_day'];
$leave_date         = $_REQUEST['leave_date'];
$date_from          = $_REQUEST['date_from'];
$date_to            = $_REQUEST['date_to'];
$leave_type         = $_REQUEST['leave_type'];
$comments           = $_REQUEST['comments'];
$no_pay_check       = (trim($_REQUEST['no_pay_check']) != '' ? trim($_REQUEST['no_pay_check']) : 1);

$transaction_flag = TRUE;

if($leave_type != '' && $leave_day_type != '') {
    
    $replacer_employee = NULL;
    $sms_replacer_employees = array();
    $need_sms_for_replacer_employee_selection = FALSE;
    
    if($_SESSION['user_role'] != 3){
        if(isset($_REQUEST['need_replacer_sms']) && strtoupper(trim($_REQUEST['need_replacer_sms'])) == 'TRUE'){
            $need_sms_for_replacer_employee_selection = TRUE;
            $sms_replacer_employees = $_REQUEST['sms_replacer_emps'];
        } else {
            $replacer_employee = (trim($_REQUEST['leave_replacer']) != '') ? trim($_REQUEST['leave_replacer']) : NULL;
        }
    }
    
    if($leave_day_type == 1){                   //add leave if it is between date
        if($date_from != '' && $date_to != '' && $date_from <= $date_to) {
            if(!$employee->check_complementary_exists($employee_username, $date_from, $date_to, '', '')){
                $leave_transaction = $employee->employee_add_leave($employee_username, $date_from, $date_to, $leave_type, $comments, $replacer_employee, $no_pay_check);
                if($leave_transaction === TRUE) {
                    $message->set_message('success', 'saved_leave');
                    $message->set_message_exact('success', ' '.$date_from.' - '.$date_to);
                    
                    if($need_sms_for_replacer_employee_selection && !empty($sms_replacer_employees)){
                        //send sms for replacer employees
                        $obj_customer = new customer();
                        
                        $leave_slots = $obj_leave->get_employee_leave_slots_between_dates($employee_username,$date_from, $date_to);
                        send_sms_for_replacer_employee_selection($smarty, $leave_slots, $sms_replacer_employees, $_REQUEST['opt_sms_conformation'], $_REQUEST['opt_sms_sender'], $_REQUEST['opt_sms_rejection']);
                    }
                    
                } else if(is_array($leave_transaction)){
                    $transaction_flag = FALSE;
                    if($leave_transaction['reason'] == 'no_replacer_avail_slot' && !empty($leave_transaction['no_replacer_avail_slots'])){
                        $message->set_message('fail', 'cant_save_leave');
                        $not_avail_label = $smarty->translate['no_employee_available'];
                        $message->set_message_exact('fail', $not_avail_label. ' ' . $leave_transaction['no_replacer_avail_slots']['date'].' => '. $leave_transaction['no_replacer_avail_slots']['time_from']. ' - '. $leave_transaction['no_replacer_avail_slots']['time_to']);
                    }
                    else if($leave_transaction['reason'] == 'Leave_already_exist'){
                        $error_message = '';
                        foreach($leave_transaction['leave_ids'] as $k => $exist_lid){
                            $existed_leave_details = $employee->get_leave_details_byID($exist_lid['id'], FALSE);
                            if($k != 0) $error_message .= '\n ';
                            $error_message .= ' '. $existed_leave_details[0]['leave_employee']. ' > '. $existed_leave_details[0]['leave_date']. ' => '.  str_pad($existed_leave_details[0]['time_from'], 5, '0', STR_PAD_LEFT). ' - '. str_pad($existed_leave_details[0]['time_to'], 5, '0', STR_PAD_LEFT);
                        }
                        $message->set_message('fail', 'employee_already_taken_leave');
                        $message->set_message_exact('fail', $error_message);
                    }
                    else
                        $message->set_message('fail', 'cant_save_leave');
                } else{
                    $transaction_flag = FALSE;
                    $message->set_message('fail', 'cant_save_leave');
                }
            }else{
                $transaction_flag = FALSE;
                $message->set_message('fail', 'complementary_exists');
            }
        }
    }
    else if($leave_day_type == 2) {           //add leave if it is between time
            
            $range_from = $date_calc->time_to_sixty($_REQUEST['leave_range_from']);
            $range_to = $date_calc->time_to_sixty($_REQUEST['leave_range_to']);
                        
            if ($range_to == 0) $range_to = 24.00;
            if ($range_to == 24) $range_to = 24.00;
            
            if(($leave_date != '' && $range_from != '' && $range_to != '') || ($range_from < $range_to)) {
                if ($range_from != false && $range_to != false) {
                    $process_flag = TRUE;
                    if($replacer_employee != NULL){
                        $obj_customer = new customer();
                        $slot_details = $obj_customer->customer_employee_slot_details($slot_id);
                        $avail_replace_employees = $employee->get_available_users($slot_details['customer'], $range_from, $range_to, $leave_date, $replacer_employee);
                        if(empty($avail_replace_employees)) {
                            $process_flag = FALSE;
                            $message->set_message('fail', 'no_employee_available');
                            $transaction_flag = FALSE;
                        }
                    }
                    if($process_flag){
                        if(!$employee->check_complementary_exists($employee_username, $leave_date, '',$range_from, $range_to)){
                            $process_save_leave = $employee->employee_add_leave_slot($employee_username, $leave_date, $range_from, $range_to, $leave_type, $comments, $replacer_employee, $no_pay_check);
                            if($process_save_leave === TRUE) {
                                $message->set_message('success', 'saved_leave');
                                $message->set_message_exact('success', ' '.$leave_date.' '.  str_pad($range_from, 5, '0', STR_PAD_LEFT). ' - '. str_pad($range_to, 5, '0', STR_PAD_LEFT));
                                
                                if($need_sms_for_replacer_employee_selection && !empty($sms_replacer_employees)){
                                    //send sms for replacer employees
                                    $obj_customer = new customer();
                                    $leave_slots = $obj_leave->get_employee_leave_slots($employee_username, $leave_date, $range_from, $range_to);
                                    send_sms_for_replacer_employee_selection($smarty, $leave_slots, $sms_replacer_employees, $_REQUEST['opt_sms_conformation'], $_REQUEST['opt_sms_sender'], $_REQUEST['opt_sms_rejection']);
                                }
                            }
                            //if save process failes
                            else if(is_array ($process_save_leave)){
                                $transaction_flag = FALSE;
                                if($process_save_leave['reason'] == 'Leave_already_exist'){
                                    $existed_leave_id = $process_save_leave['leave_ids'][0]['id'];
                                    $existed_leave_details = $employee->get_leave_details_byID($existed_leave_id, FALSE);
                                    $message->set_message('fail', 'employee_already_taken_leave');
                                    $message->set_message_exact('fail', ' '. $existed_leave_details[0]['leave_employee']. ' > '. $existed_leave_details[0]['leave_date']. ' => '.  str_pad($existed_leave_details[0]['time_from'], 5, '0', STR_PAD_LEFT). ' - '. str_pad($existed_leave_details[0]['time_to'], 5, '0', STR_PAD_LEFT));
                                }else
                                    $message->set_message('fail', 'cant_save_leave');
                            }
                            else{
                                $transaction_flag = FALSE;
                                $message->set_message('fail', 'cant_save_leave');
                            }
                        }else{
                            $transaction_flag = FALSE;
                            $message->set_message('fail', 'complementary_exists');
                        }
                    }
                }else {
                    $transaction_flag = FALSE;
                    $message->set_message('fail', 'invalid_time');
                }
            }else{
                $transaction_flag = FALSE;
                $message->set_message('fail', 'invalid_time');
            }
        }
}else {
    $transaction_flag = FALSE;
    $message->set_message('fail', 'cant_save_leave');
}

$return_obj = new stdClass();
$return_obj->result = $transaction_flag;
$message_data = $message->show_message_data_for_gritter();
$return_obj->message = $message_data->message;
echo json_encode($return_obj);

function send_sms_for_replacer_employee_selection($smarty, $leave_slots, $replacer_employees, $opt_sms_conformation, $opt_sms_sender, $opt_sms_rejection){
    
    if(empty($replacer_employees) || empty($leave_slots)) return FALSE;
     
    $obj_sms = new sms();
    $obj_leave = new leave();
    $obj_customer = new customer();
    //$obj_sms->setCallback($smarty->url.'sms_callback.php');
    $obj_sms->setCallback('http://demo.arioninfotech.co.in/t2v/sms_callback.php');
//    $obj_sms->setTag($slot_details['id']);
    
    $status = 0;
    if($opt_sms_conformation == 1){
        if($opt_sms_sender == 0) $status = 0;
        else if($opt_sms_sender == 1) $status = 4;
    }else if($opt_sms_conformation == 0){
        if($opt_sms_sender == 1 && $opt_sms_rejection == 1) $status = 8;
        else if($opt_sms_sender == 1) $status = 6;
        else if($opt_sms_rejection == 1) $status = 7;
        else if($opt_sms_sender == 0 && $opt_sms_rejection == 0) $status = 5;
    }
    
    $sms_process_flag = TRUE;
    foreach($leave_slots AS $leave){
        $slot_id_leave = $leave['id'];
        $slot_details = $obj_customer->customer_employee_slot_details($slot_id_leave);
        $sms_message = '%0A'.$smarty->translate['customer'].' : ' . $slot_details['customer'].'%0A'.$smarty->translate['date'].' : '. $slot_details['date'] . '%0A'.$smarty->translate['shift'].' : ' . $slot_details['slot'].'('.$slot_details['slot_hour'].'h)';
        $sms_message .= '%0A'.$smarty->translate['answer_yes'];
        $obj_sms->message = $sms_message;
        foreach($replacer_employees as $user){
            $mobile = $obj_leave->get_employee_mobile($user);
            $obj_sms->clearRecipients();
            if($mobile != ''){
                $obj_leave->begin_transaction();
                $tag_id = $obj_leave->update_sms_records($slot_details['id'], $user, $status);
//                echo 'tag_id: '.$tag_id;
//                echo $tag_id === FALSE ? 'Error' : 'Success';
                if($tag_id == FALSE){
                    $obj_leave->rollback_transaction();
                    continue;
                }else
                    $obj_leave->commit_transaction ();
                
                $obj_sms->setTag($tag_id);
                $obj_sms->addRecipient($mobile);
                if(!$obj_sms->send())
                    $sms_process_flag = FALSE;
            }
        }
    }
    return $sms_process_flag;
}

?>