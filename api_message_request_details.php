<?php
session_start();
require_once('class/setup.php');
require_once('class/leave.php');
require_once('class/sms.php');
$smarty = new smartySetup(array("user.xml", "gdschema.xml", "month.xml","button.xml","messages.xml", "mail.xml"), FALSE);
$leave = new leave();
$leave_details = $leave->get_slot_by_id($_REQUEST['slot_id']);
$leave->con_status = $_REQUEST['con_status'];
$_REQUEST['reciever_ids'] = rawurldecode($_REQUEST['reciever_ids']);
$leave->reciever_ids = $_REQUEST['reciever_ids'];
$recipents = explode(",",$_REQUEST['reciever_ids']);
$obj->success = 0;
//$sms_message = '%0Akunder : ' . $leave_details['customer'].'%0Adatum : '. $leave_details['date'] . '%0Aflytta : ' . $leave_details['time_from'] . '-' . $leave_details['time_to'];
//$sms_message .= '%0AJa';
$sms_message = '%0A'.$smarty->translate['customer'].' : ' . $leave_details['customer'].'%0A'.$smarty->translate['date'].' : '. $leave_details['date'] . '%0A'.$smarty->translate['shift'].' : ' . $leave_details['time_from'] . '-' . $leave_details['time_to'];
$sms_message .= '%0A'.$smarty->translate['answer_yes'];
$obj_sms = new sms($sms_message);
$obj_sms->setCallback($smarty->url.'sms_callback.php');
//$obj_sms->setTag($_REQUEST['slot_id']);
$status = 0;
if($leave->con_status == 2){
    $status = 4;
}else if($leave->con_status == 1){
    $status = 8;
}

$have_sms_receipients = FALSE;
$sms_process_flag = TRUE;

foreach ($recipents as $recipient) {
        
        $obj_sms->clearRecipients();
	$mobile = $leave->get_employee_mobile($recipient);
	if ($mobile != '') {
                $leave->begin_transaction();
                $have_sms_receipients = TRUE;
                $tag_id = $leave->update_sms_records($_REQUEST['slot_id'],$recipient, $status);
                $obj_sms->addRecipient($mobile);
                
                if($tag_id == FALSE){
                    $leave->rollback_transaction();
                    $sms_process_flag = FALSE;
                    continue;
                }else
                    $leave->commit_transaction ();
                
                $obj_sms->setTag($tag_id);
                if(!$obj_sms->send())
                    $sms_process_flag = FALSE;
	}
}

$leave->begin_transaction();
if ($have_sms_receipients) {
	if ($sms_process_flag) {
		$obj->sms = TRUE;
                $obj->success = $leave->update_user_leave($_REQUEST['slot_id']);
                $relation_details = $leave->get_slot_by_id($leave_details['relation_id']);
                $obj->customer = $leave_details['customer'];
                $obj->date = $leave_details['date'];
                $obj->time_from = $leave_details['time_from'];
                $obj->time_to = $leave_details['time_to'];
                $obj->slot_id = $_REQUEST['slot_id'];
                $obj->employee = $relation_details['employee'];
                $leave->commit_transaction();
                
	} else {
            $obj->sms = FALSE;
            $leave->rollback_transaction();
            $obj->success = 0;
	}
} else {
	$obj->sms = TRUE;
        $obj->success = $leave->update_user_leave($_REQUEST['slot_id']);
        $relation_details = $leave->get_slot_by_id($leave_details['relation_id']);
        $obj->customer = $leave_details['customer'];
        $obj->date = $leave_details['date'];
        $obj->time_from = $leave_details['time_from'];
        $obj->time_to = $leave_details['time_to'];
        $obj->slot_id = $_REQUEST['slot_id'];
        $obj->employee = $relation_details['employee'];
        $leave->commit_transaction();
}

header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>