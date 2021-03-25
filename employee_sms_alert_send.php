<?php
require_once ('class/setup.php');
require_once ('class/employee.php');
require_once ('plugins/message.class.php');
require_once ('plugins/date_calc.class.php');
require_once ('class/customer.php');
require_once ('class/sms.php');
require_once ('class/leave.php');
$smarty = new smartySetup(array("gdschema.xml", "month.xml", "button.xml", "messages.xml", "mail.xml"),FALSE);
//$employee = new employee();
//$message = new message();
//$date_calc = new datecalc();
//$customer = new customer();
//$obj_leave = new leave();
//employee_sms_alert_send
$employees_sms  = $_REQUEST['sms_send_employees'];
$slots_ids      = $_REQUEST['slots'];
$opt_sms_conformation   = $_REQUEST['opt_sms_conformation'];
$opt_sms_sender         = $_REQUEST['opt_sms_sender'];
$opt_sms_rejection      = $_REQUEST['opt_sms_rejection'];
$transaction_result = send_sms_for_replacer_employee_selection($smarty, $employees_sms, $slots_ids, $opt_sms_conformation, $opt_sms_sender, $opt_sms_rejection);

if(isset($_REQUEST['request_from']) && ($_REQUEST['request_from'] == 'monthly_view' || $_REQUEST['request_from'] == 'gd_customer' || $_REQUEST['request_from'] == 'gd_alloc_window' || $_REQUEST['request_from'] == 'gd_timeline_customer')){
    $obj_message = new message();
    $obj_return = new stdClass();
    $obj_return->result = $transaction_result;
    if($transaction_result)
        $obj_message->set_message ('success', 'sms_send_sucess');
    else
        $obj_message->set_message ('fail', 'sms_send_failed');
    $obj_return->message = $obj_message->show_message();
    echo json_encode($obj_return);
    exit();
}
    
function send_sms_for_replacer_employee_selection($smarty, $sms_employees, $slots, $opt_sms_conformation, $opt_sms_sender, $opt_sms_rejection) {
    if (empty($sms_employees)) return FALSE;
//    $sms_message = '%0A'.$smarty->translate['customer'].' : ' . $slot_details['customer'].'%0A'.$smarty->translate['date'].' : '. $slot_details['date'] . '%0A'.$smarty->translate['shift'].' : ' . $slot_details['slot'].'('.$slot_details['slot_hour'].'h)';
////    if($_REQUEST['message'])
////        $sms_message .= '%0A'.urldecode($_REQUEST['message']);
//    $sms_message .= '%0A'.$smarty->translate['answer_yes'];
    $slots_ids = explode(",", $slots);
    $obj_sms = new sms();
    $obj_leave = new leave();
    $obj_customer = new customer();
    //$obj_sms->setCallback($smarty->url.'sms_callback.php');
    $obj_sms->setCallback('http://demo.arioninfotech.co.in/t2v/sms_callback.php');


    $status = 0;
    if ($opt_sms_conformation == 1) {
        if ($opt_sms_sender == 0)
            $status = 0;
        else if ($opt_sms_sender == 1)
            $status = 4;
    }else if ($opt_sms_conformation == 0) {
        if ($opt_sms_sender == 1 && $opt_sms_rejection == 1)
            $status = 8;
        else if ($opt_sms_sender == 1)
            $status = 6;
        else if ($opt_sms_rejection == 1)
            $status = 7;
        else if ($opt_sms_sender == 0 && $opt_sms_rejection == 0)
            $status = 5;
    }

    $sms_process_flag = TRUE;
    
    foreach ($slots_ids AS $slot) {
        $slot_id_sms = $slot;
        $slot_details = $obj_customer->customer_employee_slot_details($slot_id_sms);
        $sms_message = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_details['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_details['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_details['slot'] . '(' . $slot_details['slot_hour'] . 'h)';
        //    if($_REQUEST['message'])
        //        $sms_message .= '%0A'.urldecode($_REQUEST['message']);
        $sms_message .= '%0A' . $smarty->translate['answer_yes'];
        $obj_sms->message = $sms_message;
//        $obj_sms->setTag($slot_details['id']);
        foreach ($sms_employees as $user) {
            $mobile = $obj_leave->get_employee_mobile($user);
            $obj_sms->clearRecipients();
            if ($mobile) {
                $obj_leave->begin_transaction();
                $tag_id = $obj_leave->update_sms_records($slot_details['id'], $user, $status);
                
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