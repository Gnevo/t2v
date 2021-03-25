<?php
session_start();
$app_dir = dirname(dirname( realpath( __FILE__ ) )) ;
chdir ($app_dir);
require_once('class/setup.php');
require_once('class/leave.php');
require_once('class/sms.php');
$smarty = new smartySetup(array("user.xml", "gdschema.xml", "month.xml","button.xml","messages.xml", "mail.xml"), FALSE);
$leave = new leave();
$obj = new stdClass();

$status = 0;
$sms_message = '%0A' . $smarty->translate['customer'] . ' : ' . $_REQUEST['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $_REQUEST['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $_REQUEST['slot_time'];
//if ($_REQUEST['message'])
//    $sms_message .= '%0A' . urldecode($_REQUEST['message']);
$sms_message .= '%0A' . $smarty->translate['answer_yes'];

$obj_sms = new sms($sms_message);

$users = explode('-', $_REQUEST['users']);
if ($_REQUEST['conf'] == 1) {
    if ($_REQUEST['sender'] == 0)
        $status = 0;
    else if ($_REQUEST['sender'] == 1)
        $status = 4;
}else if ($_REQUEST['conf'] == 0) {
    if ($_REQUEST['sender'] == 1 && $_REQUEST['rejection'] == 1) {
        $status = 8;
    } else if ($_REQUEST['sender'] == 1) {
        $status = 6;
    } else if ($_REQUEST['rejection'] == 1) {
        $status = 7;
    } else if ($_REQUEST['sender'] == 0 && $_REQUEST['rejection'] == 0) {
        $status = 5;
    }
}
//array_pop($users);
    $sms_process_flag = FALSE;
    $have_sms_receipients = FALSE;
    //echo "<pre>".print_r($users, 1)."</pre>";
    if(!empty($users)){
        foreach($users as $user){
            $mobile = $leave->get_employee_mobile($user);
            $obj_sms->clearRecipients();
            if($mobile){
                $have_sms_receipients = TRUE;
                $leave->begin_transaction();
                $tag_id = $leave->update_sms_records($_REQUEST['id'], $user, $status);
                //echo "<pre>".print_r($leave->query_error_details, 1)."</pre>";
                $obj_sms->addRecipient($mobile);

                if($tag_id == FALSE){
                    $leave->rollback_transaction();
                    continue;
                }else{
                    $leave->commit_transaction ();
                }
                $obj_sms->setTag($tag_id);
                if(!$obj_sms->send())
                    $sms_process_flag = FALSE;
                else
                    $sms_process_flag = TRUE;
            }
        }
    }

$obj->sms = $sms_process_flag;




/*$leave->begin_transaction();
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
}*/

//header("content-type: text/javascript");
echo json_encode($obj);
?>