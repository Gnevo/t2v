<?php
session_start();
require_once('class/setup.php');
$smarty = new smartySetup(array("user.xml", "gdschema.xml", "month.xml","button.xml","messages.xml", "mail.xml"), FALSE);
require_once('class/leave.php');
require_once('class/employee.php');
require_once('class/sms.php');
$obj_emp = new employee();
$leave = new leave();
$leave->emp = $_REQUEST['employee'];
if($leave->update_employee_slot($_REQUEST['slot_id'])){
    $leave->tables = array('leave_sms');
    $leave->fields = array('status');
    $leave->field_values = array(1);
    $leave->conditions = array('AND', 'slot = ?', 'employee = ?');
    $leave->condition_values = array($_REQUEST['slot_id'], $_REQUEST['employee']);
    if ($leave->query_update()){
        $leave->tables = array('leave_sms');
        $leave->fields = array('status');
        $leave->field_values = array(2);
        $leave->conditions = array('AND', 'slot = ?', 'employee != ?');
        $leave->condition_values = array($_REQUEST['slot_id'], $_REQUEST['employee']);
        if ($leave->query_update()) {
            $slot_det = $obj_emp->customer_employee_slot_details($_REQUEST['slot_id']);
                            
            //sending sms to shift accepted user and allocated admin
            $sms_message_sender = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_det['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_det['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_det['time_from'] . '-' . $slot_det['time_to'] . '(' . ($slot_det['time_to'] - $slot_det['time_from']) . 'hr)';

            $obj_sms_sender = new sms($sms_message_sender);

            //sending sms to shift rejected users 
            $sms_message_rejection = '%0A' . $smarty->translate['customer'] . ' : ' . $slot_det['customer'] . '%0A' . $smarty->translate['date'] . ' : ' . $slot_det['date'] . '%0A' . $smarty->translate['shift'] . ' : ' . $slot_det['time_from'] . '-' . $slot_det['time_to'] . '(' . ($slot_det['time_to'] - $slot_det['time_from']) . 'hr)';
            $sms_message_rejection .= '%0A' . $smarty->translate['shift_rejected'];
            $obj_sms_rejection = new sms($sms_message_sender);


            $leave->tables = array('leave_sms');
            $leave->fields = array('employee', 'alloc_employee', '(SELECT mobile FROM employee where username = leave_sms.employee) AS mobile');
            $leave->conditions = array('slot = ?');
            $leave->condition_values = array($_REQUEST['slot_id']);
            $leave->query_generate();
            $sms_datas = $leave->query_fetch();
            foreach($sms_datas as $sms_data){
                if($sms_data['employee'] == $_REQUEST['employee']){
                    $sms_message_sender .= '%0A' . $smarty->translate['employee']. ' : ' . $_REQUEST['employee'];
                    $sms_message_sender .= '%0A' . $smarty->translate['shift_accepted'];
                    $mobile = $leave->get_employee_mobile($sms_data['alloc_employee']);
                    if ($mobile) {
                        $obj_sms_sender->addRecipient($mobile);
                    }
                    if($sms_data['mobile']){
                        $obj_sms_sender->addRecipient($sms_data['mobile']);
                    }

                }else{
                    if($sms_data['mobile'])
                        $obj_sms_rejection->addRecipient($sms_data['mobile']);
                }
            }
            if($obj_sms_sender->recipients)                            
                $obj_sms_sender->send();
            if($obj_sms_rejection->recipients)
                $obj_sms_rejection->send();
            
            $obj->success = true;
        } else {

            $obj->success = false;
        }

    }else{
        $obj->success = false;
    }
}

header("content-type: text/javascript");
echo $data = $_GET['callback']. '(' . json_encode($obj) . ');';
?>